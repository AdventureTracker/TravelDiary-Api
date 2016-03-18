<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TripController extends ApiController {

	public function createAction(Request $request) {

		return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);

	}

	public function updateAction(Request $request, $trip_id) {

		return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);

	}

	public function listAction() {

		$this->load_device();

		$response = [];

		foreach ($this->device->getIdUser()->getTrips() as $trip) {
			$response[] = $trip->toArray();
		}

		return new JsonResponse($response, Response::HTTP_OK);

	}

	public function getAction($trip_id) {

		$this->load_device();

		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->findOneBy([
			'trp_uuid' 			=> $trip_id
		]);

		if (!$trip)
			return new JsonResponse(['message' => "Trip not found!"], Response::HTTP_NOT_FOUND);

		return new JsonResponse($trip->toArray(true), Response::HTTP_OK);

	}

	public function removeAction($trip_id) {

		$this->load_device();

		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->findOneBy([
			'trp_uuid' 			=> $trip_id
		]);

		if (!$trip)
			return new JsonResponse(['message' => "Trip not found!"], Response::HTTP_NOT_FOUND);

		$em = $this->getDoctrine()->getManager();
		$em->remove($trip);
		$em->flush();

		return new JsonResponse(null, Response::HTTP_NO_CONTENT);

	}

}
