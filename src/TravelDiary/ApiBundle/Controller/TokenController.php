<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\CoreBundle\Entity\ApiToken;
use TravelDiary\CoreBundle\Helper\UUID;

class TokenController extends Controller {

	public function deleteAction(Request $request) {

		$apiToken 				= $request->headers->get("X-TravelDiary-Token");

		$token = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:ApiToken")->findOneBy([
			'tokValue' 			=> $apiToken
		]);

		if (!$token)
			return new JsonResponse(['message' => "Token not found. It's impossible but shit happens!"], Response::HTTP_NOT_FOUND);

		$em = $this->getDoctrine()->getManager();
		$em->remove($token);
		$em->flush();

		return new JsonResponse(null, Response::HTTP_NOT_IMPLEMENTED);
	}

	public function createAction(Request $request) {

		$data 					= json_decode($request->getContent(), true);

		$deviceUUID 			= $request->headers->get('X-TravelDiary-Device');

		$user 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:User")->findOneBy([
			'usrPassword' 		=> $data['password'],
			'usrEmail' 			=> $data['email']
		]);

		if (!$user)
			return new JsonResponse(['message' => "Invalid credentials!"], Response::HTTP_UNAUTHORIZED);

		$device 				= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->findByUser($user, $deviceUUID);

		if (!$device)
			return new JsonResponse(['message' => "Invalid credentials!"], Response::HTTP_UNAUTHORIZED);

		$apiToken 				= new ApiToken();
		$apiToken->setIdDevice($device);
		$apiToken->setTokValue(UUID::generateUUID());

		$em 					= $this->getDoctrine()->getManager();
		$em->persist($apiToken);
		$em->flush();

		$result 				= [
			'token' 			=> $apiToken->getTokValue()
		];

		return new JsonResponse($result, Response::HTTP_CREATED);
	}

}
