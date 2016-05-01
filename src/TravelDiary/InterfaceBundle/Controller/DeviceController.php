<?php

namespace TravelDiary\InterfaceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TravelDiary\ApiBundle\Exception\ApiException;

class DeviceController extends Controller {
	
	public function overviewAction(Request $request, int $page) {

		if ($request->isXmlHttpRequest()) {
			
			$devices = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->getDevicesByUserPaginated($this->getUser(), $page, $this->getParameter("pagination.limit"));
			$devicesCount = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->getDevicesByUserPaginatedCount($this->getUser(), $page, $this->getParameter("pagination.limit"));

			return $this->render('@TravelDiaryInterface/Device/_list.html.twig', [
				'devices' 	=> [
					'items' 	=> $devices,
					'count' 	=> $devicesCount,
					'page' 		=> $page,
					'pages' 	=> ceil($devicesCount / $this->getParameter("pagination.limit"))
				]
			]);

		}

		return $this->render("@TravelDiaryInterface/Device/overview.html.twig", [
			'page' 				=> $page
		]);
		
	}
	
	public function editAction(Request $request, int $idDevice) {

		return $this->render('@TravelDiaryInterface/Device/edit.html.twig');

	}
	
	public function removeAction(Request $request, int $idDevice) {

		if (!$request->isXmlHttpRequest())
			throw $this->createNotFoundException();

		$device = $this->getDoctrine()->getRepository("TravelDiaryCoreBundle:Device")->find($idDevice);

		if (!$device)
			throw new ApiException("Device not found!", Response::HTTP_NOT_FOUND);

		if (!$this->getUser()->getDevices()->contains($device))
			throw new ApiException("You have no permission for this operation!", Response::HTTP_FORBIDDEN);

		try {
			$em = $this->getDoctrine()->getManager();
			$em->remove($device);
			$em->flush();
		}
		catch (\Exception $e) {
			throw new ApiException("Error while processing request!", Response::HTTP_INTERNAL_SERVER_ERROR);
		}

		return new JsonResponse(['message' => 'Device successfully removed!'], Response::HTTP_NO_CONTENT);

	}
	
}
