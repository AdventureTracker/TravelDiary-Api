<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\CoreBundle\Entity\ApiEntity;

class EnumController extends Controller {
    
    public function listAction() {

		$enums = [
			'statuses' 			=> ApiEntity::prepare($this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Status")->findAll()),
			'record_types' 		=> ApiEntity::prepare($this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Recordtype")->findAll()),
			'privacy_levels' 	=> ApiEntity::prepare($this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Privacy")->findAll()),
			'users' 			=> ApiEntity::prepare($this->getDoctrine()->getRepository("TravelDiaryCoreBundle:User")->findAll())
		];

		return new JsonResponse($enums, Response::HTTP_OK);
    }

}
