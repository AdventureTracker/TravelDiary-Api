<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller {

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
