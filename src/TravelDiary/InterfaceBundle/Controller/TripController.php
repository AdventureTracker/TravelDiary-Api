<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;

class TripController extends Controller
{
	public function overviewAction(Request $request, $page) {

		if ($request->isXmlHttpRequest()) {

			$trips = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->getTripsByUserPaginated($this->getUser(), $page, 20);

			return $this->render('@TravelDiaryInterface/Trip/_tables/trips.html.twig', [
				'trips' 		=> [
					'items' 	=> $trips,
					'count' 	=> $this->getUser()->getTrips()->count(),
					'page' 		=> $page,
					'pages' 	=> ceil($this->getUser()->getTrips()->count() / 20)
				]
			]);
		}
		else {
			return $this->render('TravelDiaryInterfaceBundle:Trip:overview.html.twig', [
				'page' 			=> $page
			]);
		}
	}

	public function formAction() {
		return $this->render('TravelDiaryInterfaceBundle:Trip:form.html.twig', array(
			// ...
		));
	}

	public function processAction($id)
	{

	}

	public function viewAction(Request $request, $id) {

		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($id);

		if (!$trip)
			$this->createNotFoundException("Trip not found!");

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("Permission denied!", Response::HTTP_FORBIDDEN);

		if ($request->isXmlHttpRequest()) {
			$records = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Record")->getRecordsByTripPaginated($trip, $request->query->get('page', 1), 20, $request->query->get('query', ''));
			return $this->render("@TravelDiaryInterface/Trip/_tables/records.html.twig", [
				'records' 			=> [
					'items' 		=> $records,
					'count' 		=> $trip->getTripRecords()->count(),
					'page' 			=> $request->query->get('page', 1),
					'pages' 		=> ceil($trip->getTripRecords()->count() / 20)
				],
				'trip' 				=> $trip
			]);
		}

		return $this->render('TravelDiaryInterfaceBundle:Trip:view.html.twig', array(
			'trip' 				=> $trip
		));
	}

	public function removeAction($id) {

		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($id);

		if (!$trip)
			throw new ApiException("Trip not found!", Response::HTTP_NOT_FOUND);

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("Permission denied!", Response::HTTP_FORBIDDEN);

		try {
			$em = $this->getDoctrine()->getManager();
			$em->remove($trip);
			$em->flush();
		}
		catch (\Exception $e) {
			throw new ApiException("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
		}

		return new JsonResponse(null, Response::HTTP_NO_CONTENT);

	}

}
