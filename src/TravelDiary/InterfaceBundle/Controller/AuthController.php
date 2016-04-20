<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TravelDiary\ApiClient\ApiClientFactory;
use TravelDiary\InterfaceBundle\Security\UserFromApi;

class AuthController extends Controller {


	protected $apiClientFactory;

	/**
	 * AuthController constructor.
	 * @param ApiClientFactory $apiClientFactory
	 */
	public function __construct(ApiClientFactory $apiClientFactory)
	{
		$this->apiClientFactory = $apiClientFactory;
	}

	/**
	 * @return \GuzzleHttp\Client
	 */
	public function getApiClient() {

		if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
			
			if ($this->getUser() instanceof UserFromApi) {
				$this->apiClientFactory->setClientSecret($this->getUser()->getUserApiSecret());
				$this->apiClientFactory->setClientToken($this->getUser()->getUserApiToken());
			}
			
		}

		return $this->apiClientFactory->create();

	}

	public function loginAction(Request $request) {

		$authenticationUtils = $this->get('security.authentication_utils');

		$error 			= $authenticationUtils->getLastAuthenticationError();
		$lastEmail 		= $authenticationUtils->getLastUsername();

		return $this->render('TravelDiaryInterfaceBundle:Auth:login.html.twig', array(
			'error' => $error,
			'lastEmail' => $lastEmail
		));

	}

	public function processRegisterAction(Request $request) {
		return $this->render('TravelDiaryInterfaceBundle:Auth:register.html.twig', array(
			// ...
		));
	}



	public function registerAction() {
		return $this->render('TravelDiaryInterfaceBundle:Auth:register.html.twig', array(
			// ...
		));
	}

	public function lostPasswordAction() {
		return $this->render('TravelDiaryInterfaceBundle:Auth:lost_password.html.twig', array(
			// ...
		));
	}

}
