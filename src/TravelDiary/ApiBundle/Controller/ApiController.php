<?php

namespace TravelDiary\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TravelDiary\ApiBundle\Exception\UnauthorizedAccessException;
use TravelDiary\CoreBundle\Entity\Device;

class ApiController extends Controller {

	/**
	 * @var Device User device
	 */
	protected $device;

	public function __construct()
	{

		$request = Request::createFromGlobals();

		$device_uuid = $request->headers->get('X-TravelDiary-Device', null);

		if (!$device_uuid)
			throw new UnauthorizedAccessException("Can't find X-TravelDiary-Device");

		$this->device = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->findOneBy([
			'dev_uuid' 			=> $device_uuid
		]);

		if (!$this->device)
			throw new UnauthorizedAccessException("Invalid device!");

	}

}
