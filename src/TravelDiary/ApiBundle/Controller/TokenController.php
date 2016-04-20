<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;
use TravelDiary\CoreBundle\Entity\ApiToken;
use TravelDiary\CoreBundle\Entity\Device;
use TravelDiary\CoreBundle\Entity\User;
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

		return new JsonResponse(null, Response::HTTP_NO_CONTENT);
	}

	public function createAction(Request $request) {

		$data 					= json_decode($request->getContent(), true);

		$deviceUUID 			= $request->headers->get('X-TravelDiary-Device');

		$user 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:User")->findOneBy([
			'usrEmail' 			=> $data['email']
		]);

		if (!($user && password_verify($data['password'], $user->getUsrPassword())))
			throw new ApiException("Invalid credentials!", Response::HTTP_UNAUTHORIZED);

		$em 					= $this->getDoctrine()->getManager();

		$device 				= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->findOneBy([
			'idUser' 			=> $user,
			'devUUID' 			=> $deviceUUID,
			'devType' 			=> Device::TYPE_PHONE
		]);

		if (!$user->getDevices()->contains($device))
			throw new ApiException("Permission denied!", Response::HTTP_FORBIDDEN);

		if (!$device) {
			$device 			= new Device();
			$device->setIdUser($user);
			$device->setDevUUID($deviceUUID);
			$device->setDevType(Device::TYPE_PHONE);
			$em->persist($device);
		}


		$apiToken 				= new ApiToken();
		$apiToken->setIdDevice($device);
		$apiToken->setTokValue(UUID::generateUUID());

		$em->persist($apiToken);
		$em->flush();

		$result 				= [
			'token' 			=> $apiToken->getTokValue()
		];

		return new JsonResponse($result, Response::HTTP_CREATED);
	}

}
