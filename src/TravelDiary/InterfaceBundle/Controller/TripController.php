<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;
use TravelDiary\CoreBundle\Entity\Trip;
use TravelDiary\CoreBundle\Form\TripType;

class TripController extends Controller {

	public function overviewAction(Request $request, $page) {

		if ($request->isXmlHttpRequest()) {

			$trips = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->getTripsByUserPaginated($this->getUser(), $page, $this->getParameter("pagination.limit"));

			return $this->render('@TravelDiaryInterface/Trip/list.html.twig', [
				'trips' 		=> [
					'items' 	=> $trips,
					'count' 	=> $this->getUser()->getTrips()->count(),
					'page' 		=> $page,
					'pages' 	=> ceil($this->getUser()->getTrips()->count() / $this->getParameter("pagination.limit"))
				]
			]);

		}

		return $this->render('TravelDiaryInterfaceBundle:Trip:overview.html.twig', [
			'page' 			=> $page
		]);
	}

	public function formAction($idTrip) {

		if ($idTrip > 0) {
			$trip 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($idTrip);
			if (!$trip)
				throw $this->createNotFoundException("Trip not found!");
		}
		else {
			$trip 					= new Trip();
		}

		$form = $this->createForm(TripType::class, $trip, [
			'action' 	=> $this->generateUrl('processTrip', [
				'idTrip' => $idTrip
			])
		]);

		return $this->render('TravelDiaryInterfaceBundle:Trip:form.html.twig', array(
			'form' 					=> $form->createView(),
			'idTrip' 				=> $idTrip
		));
	}

	public function processAction(Request $request, $idTrip) {

		if ($idTrip > 0) {
			$trip 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($idTrip);
			if (!$trip)
				throw $this->createNotFoundException("Trip not found!");
		}
		else {
			$trip 					= new Trip();
		}

		$form = $this->createForm(TripType::class, $trip, [
			'action' 	=> $this->generateUrl('processTrip', [
				'idTrip' => $idTrip
			])
		]);

		$form->handleRequest($request);

		if ($form->isValid()) {
			$em = $this->getDoctrine()->getManager();
			$em->persist($trip);
			$em->flush();
			$this->addFlash('success', "Trip created!");
			return $this->redirectToRoute('viewTrip', [
				'idTrip' 	=> $trip->getIdTrip()
			]);
		}

		return $this->render('TravelDiaryInterfaceBundle:Trip:form.html.twig', array(
			'form' 					=> $form->createView(),
			'idTrip' 				=> $idTrip
		));
	}

	public function viewAction(Request $request, $idTrip) {

		$trip = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->find($idTrip);

		if (!$trip)
			$this->createNotFoundException("Trip not found!");

		if (!$trip->getUsers()->contains($this->getUser()))
			throw new ApiException("Permission denied!", Response::HTTP_FORBIDDEN);

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
