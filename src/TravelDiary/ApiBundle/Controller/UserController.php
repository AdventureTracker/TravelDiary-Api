<?php
/**
 * Created by PhpStorm.
 * User: jdubec
 * Date: 19/04/16
 * Time: 16:44
 */

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

class UserController extends Controller
{

	public function loginAction(Request $request) {

		$data 					= json_decode($request->getContent(), true);

		$user 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:User")->findOneBy([
			'usrEmail' 			=> $data['email']
		]);

		if (!($user && password_verify($data['password'], $user->getUsrPassword())))
			throw new ApiException("Invalid credentials!", Response::HTTP_UNAUTHORIZED);

		$em 					= $this->getDoctrine()->getManager();

		$user->setUsrLastseen(new \DateTime());
		$em->persist($user);

		$device 				= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->findOneBy([
			'idUser' 			=> $user,
			'devType' 			=> Device::TYPE_WEB
		]);

		if (!$device) {
			$device 			= new Device();
			$device->setIdUser($user);
			$device->setDevType(Device::TYPE_WEB);
			$device->setDevUUID(UUID::generateUUID());
			$device->setDevCreatedAt(new \DateTime());

			$em->persist($device);
		}

		$apiToken 				= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:ApiToken")->findOneBy([

		]);

		if (!$apiToken) {
			$apiToken 			= new ApiToken();
			$apiToken->setIdDevice($device);
			$apiToken->setTokCreatedAt(new \DateTime());
			$apiToken->setTokValue(UUID::generateUUID());
			$em->persist($apiToken);
		}

		try {
			$em->flush();
		}
		catch (\Exception $e) {
			throw new ApiException("Unable to update devices", Response::HTTP_INTERNAL_SERVER_ERROR, $e);
		}

		$response = [
			'token' 			=> $apiToken->getTokValue(),
			'secret' 			=> $device->getDevUUID()
		];

		$response = array_merge($response, $user->toArray(true));

		return new JsonResponse($response);

	}

	public function viewAction(Request $request, $email) {

		$user 					= $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:User")->findOneBy([
			'usrEmail' 			=> $email
		]);

		return new JsonResponse($user->toArray());

	}

	public function meAction() {

		return new JsonResponse($this->getUser()->toArray());

	}

}