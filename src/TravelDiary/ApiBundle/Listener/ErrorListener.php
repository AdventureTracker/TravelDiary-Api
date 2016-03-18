<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 18.03.2016
 * Time: 0:39
 */

namespace TravelDiary\ApiBundle\Listener;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use TravelDiary\ApiBundle\Exception\ApiException;

class ErrorListener
{

	public function onKernelException(GetResponseForExceptionEvent $event) {
		$exception = $event->getException();

		if ($exception instanceof ApiException) {
			$response = new JsonResponse(['message' => $exception->getMessage()], $exception->getCode());
			$event->setResponse($response);
		}
	}

}