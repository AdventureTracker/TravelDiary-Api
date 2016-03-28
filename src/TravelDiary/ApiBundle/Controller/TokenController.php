<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller {

	public function deleteAction(Request $request) {

		if ($request->getMethod() != Request::METHOD_DELETE)
			return new JsonResponse(null, Response::HTTP_METHOD_NOT_ALLOWED);

		return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);
	}

	public function createAction(Request $request) {

		$email 					= $request->request->get('email');
		$password 				= $request->request->get('password');

		$data 					= json_decode($request->getContent());

		var_dump($data);

		return new JsonResponse($data, Response::HTTP_NOT_IMPLEMENTED);
	}

}
