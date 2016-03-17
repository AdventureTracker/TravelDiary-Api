<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller {

	public function statusAction() {

		$response = [
			'status' 		=> [
				'records' 			=> '',
				'users' 			=> '',
				'trips' 			=> ''
			],
			'timestamp' 			=> (new \DateTime())->getTimestamp()
		];

		return new JsonResponse($response, Response::HTTP_UNAUTHORIZED);

	}

}
