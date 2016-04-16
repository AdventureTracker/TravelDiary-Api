<?php

namespace TravelDiary\ApiBundle\Controller;

use CrEOF\Spatial\PHP\Types\Geometry\Point;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;
use TravelDiary\ApiBundle\File\ApiUploadedFile;
use TravelDiary\ApiBundle\Helper\ApiRequestProcessor;
use TravelDiary\CoreBundle\Entity\Photo;
use TravelDiary\CoreBundle\Entity\Record;

class TripRecordController extends Controller {

	public function processAction(Request $request, $idTrip, $idTripRecord = '') {

		$data 						= ApiRequestProcessor::requestBodyToArray($request);

		if (empty($data))
			throw new ApiException("Empty body request!", Response::HTTP_BAD_REQUEST);

		$trip 						= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->findOneBy([
			'trpUUID' 				=> $idTrip
		]);

		if (!$trip)
			throw new ApiException("Trip not found!", Response::HTTP_NOT_FOUND);

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("You don't have permissions!", Response::HTTP_FORBIDDEN);

		if (empty($idTripRecord)) {
			$tripRecord 			= new Record();
			$tripRecord->setRecUUID($data['id']);
			$tripRecord->setRecCreatedAt(new \DateTime());
			$tripRecord->setIdUser($this->getUser());
		}
		else {
			$tripRecord 			= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Record")->findOneBy([
				'recUUID' 			=> strtolower($idTripRecord)
			]);

			if (!$tripRecord)
				throw new ApiException("Trip record not found!", Response::HTTP_NOT_FOUND);

			if (!$trip->getTripRecords()->contains($tripRecord))
				throw new ApiException("Invalid parent!", Response::HTTP_UNPROCESSABLE_ENTITY);
		}

		$missingFields 				= ApiRequestProcessor::validateArrayBody($data, $tripRecord);
		if (!empty($missingFields))
			throw new ApiException(sprintf("Missing required fields (%s)!", implode(', ', $missingFields)), Response::HTTP_UNPROCESSABLE_ENTITY);

		$recordType 				= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Recordtype")->findOneBy([
			'retCode' 				=> $data['type']
		]);

		if (!$recordType)
			throw new ApiException("Invalid value for type field!", Response::HTTP_UNPROCESSABLE_ENTITY);

		$tripRecord->setIdTrip($trip);
		$tripRecord->setIdRecordtype($recordType);
		$tripRecord->setRecDay($data['day']);
		$tripRecord->setRecUpdatedAt(new \DateTime());

		if (isset($data['description']))
			$tripRecord->setRecDescription($data['description']);

		if (isset($data['coordinates'])) {
			$tripRecord->setRecLocation(new Point($data['coordinates']['latitude'], $data['coordinates']['longitude']));
			$tripRecord->setRecAltitude($data['coordinates']['altitude']);
		}


		// Removing all existing photos from entity, setting later
		$tripRecord->getPhotos()->clear();

		$em = $this->getDoctrine()->getManager();
		$em->persist($tripRecord);

		if (isset($data['photos'])) {

			// Creating upload dir if not exists
			$uploadDir = sprintf("%s/../web/upload", $this->get("kernel")->getRootDir());
			if (!is_dir($uploadDir))
				mkdir($uploadDir, 0775);

			// Preparing upload dir for trip based on trip UUID
			$tripUploadDir = sprintf("%s/%s", $uploadDir, $trip->getTrpUUID());
			if (!is_dir($tripUploadDir))
				mkdir($tripUploadDir, 0775);

			foreach ($data['photos'] as $image) {

				$photo = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Photo")->findOneBy([
					'phtUUID' => $image['id']
				]);

				// If photo doesn't exist, creating new
				if (!$photo) {

					$imageFile = new ApiUploadedFile($image['data'], sprintf("%s/%s", $tripUploadDir, $image['id']));

					$photo = new Photo();
					$photo->setPhtUUID($image['id']);
					$photo->setPhtCreatedAt(new \DateTime());
					$photo->setPhtFilename(sprintf("%s.%s", $image['id'], $imageFile->getExtension()));
					$photo->setPhtMIME($imageFile->getMime());

				}

				$photo->setIdRecord($tripRecord);
				$em->persist($photo);
				$tripRecord->addPhoto($photo);

			}

		}

		try {
			$em->flush();
		}
		catch (\Exception $e) {
			throw new ApiException("Shit happens! Write to support@idontgiveafuck.com for help.", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
		}

		return new JsonResponse($tripRecord->toArray(true), empty($idTripRecord) ? Response::HTTP_CREATED : Response::HTTP_OK);
	}

	public function removeAction($idTrip, $idTripRecord) {

		$trip 						= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->findOneBy([
			'trpUUID' 				=> $idTrip
		]);

		if (!$trip)
			throw new ApiException("Trip not found!", Response::HTTP_NOT_FOUND);

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("You don't have permissions!", Response::HTTP_FORBIDDEN);

		$tripRecord 			= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Record")->findOneBy([
			'recUUID' 			=> strtolower($idTripRecord)
		]);

		if (!$tripRecord)
			throw new ApiException("Trip record not found!", Response::HTTP_NOT_FOUND);

		if (!$trip->getTripRecords()->contains($tripRecord))
			throw new ApiException("Invalid parent!", Response::HTTP_UNPROCESSABLE_ENTITY);

		try {
			$em 				= $this->getDoctrine()->getManager();
			$em->remove($tripRecord);
			$em->flush();
		}
		catch (\Exception $e) {
			throw new ApiException("Shit happens! Write to support@idontgiveafuck.com for help.", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
		}

		return new JsonResponse(null, Response::HTTP_NO_CONTENT);
	}

	public function detailAction($idTrip, $idTripRecord) {

		$trip 						= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->findOneBy([
			'trpUUID' 				=> $idTrip
		]);

		if (!$trip)
			throw new ApiException("Trip not found!", Response::HTTP_NOT_FOUND);

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("You don't have permissions!", Response::HTTP_FORBIDDEN);

		$tripRecord 			= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Record")->findOneBy([
			'recUUID' 			=> strtolower($idTripRecord)
		]);

		if (!$tripRecord)
			throw new ApiException("Trip record not found!", Response::HTTP_NOT_FOUND);

		if (!$trip->getTripRecords()->contains($tripRecord))
			throw new ApiException("Invalid parent!", Response::HTTP_UNPROCESSABLE_ENTITY);

		return new JsonResponse($tripRecord->toArray(true), Response::HTTP_OK);
	}

}
