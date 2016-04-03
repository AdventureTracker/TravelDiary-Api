<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {

		if ($this->isGranted('IS_AUTHENTICATED_FULLY'))
			return $this->redirectToRoute('dashboard');
		return $this->redirectToRoute('login');
    }
}
