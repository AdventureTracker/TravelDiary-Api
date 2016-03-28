<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller {

	public function statusAction() {



		$response = [
			'status' 				=> 'good',
			'stats' 				=> [
				'records' 			=> $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Record")->countRecords(),
				'users' 			=> $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:User")->countUsers(),
				'trips' 			=> $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Trip")->countTrips()
			],
			'timestamp' 			=> (new \DateTime())->getTimestamp()
		];

		return new JsonResponse($response, Response::HTTP_UNAUTHORIZED);

	}

}
