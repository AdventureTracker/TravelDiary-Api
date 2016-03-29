<?php

namespace TravelDiary\ApiBundle\Controller;

use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;
use TravelDiary\ApiBundle\Helper\ApiRequestProcessor;
use TravelDiary\CoreBundle\Entity\Trip;
use TravelDiary\CoreBundle\Entity\User;

class TripController extends Controller {

	public function processAction(Request $request, $tripUUID = '') {

		$data 						= ApiRequestProcessor::requestBodyToArray($request);

		if (empty($data))
			throw new ApiException("Empty body request!", Response::HTTP_BAD_REQUEST);

		if (empty($tripUUID)) {
			$trip 					= new Trip();
			$trip->setTrpUUID($data['id']);
			$trip->setTrpCreatedAt(new \DateTime());
		}
		else {
			$trip 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->findOneBy([
				'prdUUID' 			=> strtolower($tripUUID)
			]);

			if (!$trip)
				throw new ApiException("Trip not found!", Response::HTTP_NOT_FOUND);

			if (!$this->getUser()->getTrips()->contains($trip))
				throw new ApiException("You don't have permissions to update this record!", Response::HTTP_FORBIDDEN);
		}

		$missingFields 				= ApiRequestProcessor::validateArrayBody($data, $trip);

		if (!empty($missingFields))
			throw new ApiException(sprintf("Missing required fields (%s)!", implode(', ', $missingFields)), Response::HTTP_UNPROCESSABLE_ENTITY);

		$tripStatus 				= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Status")->findOneBy([
			'staCode' 				=> strtolower($data['status'])
		]);

		if (!$tripStatus)
			throw new ApiException("Invalid value for status field!", Response::HTTP_UNPROCESSABLE_ENTITY);

		$privacyLevel 				= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Privacy")->findOneBy([
			'prvCode' 				=> strtolower($data['privacy'])
		]);

		if (!$privacyLevel)
			throw new ApiException("Invalid value for privacy field!", Response::HTTP_UNPROCESSABLE_ENTITY);

		$trip->setTrpName($data['name']);
		$trip->setTrpDestination($data['destination']);
		$trip->setTrpDescription($data['description']);
		$trip->setTrpStartDate($data['start_date']);
		$trip->setTrpEstimatedArrival($data['estimated_arrival_date']);
		$trip->setIdPrivacy($privacyLevel);
		$trip->setIdStatus($tripStatus);
		$trip->setTrpUpdatedAt(new \DateTime());

		foreach ($data['users'] as $idUser) {
			$user 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:User")->find($idUser);
			if (!$user)
				throw new ApiException(sprintf("User ID %d not found!", $idUser), Response::HTTP_UNPROCESSABLE_ENTITY);

			$trip->addUser($user);
		}

		try {
			$em 					= $this->getDoctrine()->getManager();
			$em->persist($trip);
			$em->flush();
		}
		catch (Exception $e) {
			throw new ApiException("Shit happens!", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
		}

		return new JsonResponse($trip->toArray(), empty($trip_id) ? Response::HTTP_CREATED : Response::HTTP_OK);
	}

	public function listAction() {

		$response = [];

		/**
		 * @var $user User
		 */
		$user = $this->get("security.token_storage")->getToken()->getUser();

		foreach ($user->getTrips() as $trip) {
			$response[] = $trip->toArray();
		}

		return new JsonResponse($response, Response::HTTP_OK);

	}

	public function getAction($trip_id) {

		try {
			$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->getTripByUser($this->getUser(), $trip_id);
		}
		catch (NoResultException $e) {
			return new JsonResponse(['message' => "Trip not found!"], Response::HTTP_NOT_FOUND);
		}

		return new JsonResponse($trip->toArray(true), Response::HTTP_OK);

	}

	public function removeAction($trip_id) {

		try {
			$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->getTripByUser($this->getUser(), $trip_id);
		}
		catch (NoResultException $e) {
			return new JsonResponse(['message' => "Trip not found!"], Response::HTTP_NOT_FOUND);
		}

		$em = $this->getDoctrine()->getManager();
		$em->remove($trip);
		$em->flush();

		return new JsonResponse(null, Response::HTTP_NO_CONTENT);

	}

}
