<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;
use TravelDiary\ApiBundle\Exception\UnauthorizedAccessException;
use TravelDiary\CoreBundle\Entity\Device;

class ApiController extends Controller {

	/**
	 * @var Device User device
	 */
	protected $device;

	/**
	 * TODO: Takto to nemoze nidky fungovat. Spravit normalne security listener, teraz sa mi uz chce ale spat
	 */
	protected function load_device() {

		$request = Request::createFromGlobals();

		$device_uuid = $request->headers->get('X-TravelDiary-Device', null);

		if (!$device_uuid)
			throw new ApiException("Can't find X-TravelDiary-Device", Response::HTTP_UNAUTHORIZED);

		$this->device = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->findOneBy([
			'devUUID' 			=> $device_uuid
		]);

		if (!$this->device)
			throw new ApiException("Invalid device!", Response::HTTP_UNAUTHORIZED);

	}

}
