<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;

class TripRecordController extends Controller
{

	public function listAction(Request $request, $idTrip, $page) {

		if (!$request->isXmlHttpRequest())
			throw $this->createNotFoundException();

		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($idTrip);

		if (!$trip)
			$this->createNotFoundException("Trip not found!");

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("Permission denied!", Response::HTTP_FORBIDDEN);

		$records = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Record")->getRecordsByTripPaginated($trip, $page, $this->getParameter("pagination.limit"), $request->query->get('query', ''));
		return $this->render("@TravelDiaryInterface/TripRecord/list.html.twig", [
			'records' 			=> [
				'items' 		=> $records,
				'count' 		=> $trip->getTripRecords()->count(),
				'page' 			=> $page,
				'pages' 		=> ceil($trip->getTripRecords()->count() / $this->getParameter("pagination.limit"))
			],
			'trip' 				=> $trip
		]);

	}

	public function viewAction($trip_id, $record_id)
	{
		return $this->render('TravelDiaryInterfaceBundle:TripRecord:view.html.twig', array(
			// ...
		));
	}

	public function removeAction($idTrip, $idRecord) {
		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($idTrip);

		if (!$trip)
			throw new ApiException("Trip not found!", Response::HTTP_NOT_FOUND);

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("Permission denied!", Response::HTTP_FORBIDDEN);

		$tripRecord = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Record")->find($idRecord);

		if (!$tripRecord)
			throw new ApiException("Record not found!", Response::HTTP_NOT_FOUND);

		try {
			$em = $this->getDoctrine()->getManager();
			$em->remove($tripRecord);
			$em->flush();
		}
		catch (\Exception $e) {
			throw new ApiException("Internal server error", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
		}

		return $this->redirectToRoute("viewTrip", ['idTrip' => $trip->getIdTrip()]);
	}

	public function formAction($trip_id, $record_id)
	{
		return $this->render('TravelDiaryInterfaceBundle:TripRecord:form.html.twig', array(
			// ...
		));
	}

	public function processAction($trip_id, $record_id)
	{
		return $this->render('TravelDiaryInterfaceBundle:TripRecord:process.html.twig', array(
			// ...
		));
	}

}
