<?php

namespace TravelDiary\ApiBundle\Controller;

use Doctrine\ORM\NoResultException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\CoreBundle\Entity\User;

class TripController extends ApiController {

	public function createAction(Request $request) {

		return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);

	}

	public function updateAction(Request $request, $trip_id) {

		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($trip_id);

		if (!$trip)
			return new JsonResponse(['message' => "Trip not found!"], Response::HTTP_NOT_FOUND);

		if (!$this->getUser()->getTrips()->contains($trip))
			return new JsonResponse(['message' => "You don't have permissions to update this record!", Response::HTTP_FORBIDDEN]);

		return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);

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
