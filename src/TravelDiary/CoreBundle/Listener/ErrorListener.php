<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 18.03.2016
 * Time: 0:39
 */

namespace TravelDiary\CoreBundle\Listener;


use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use TravelDiary\ApiBundle\Exception\ApiException;
use TravelDiary\InterfaceBundle\Exception\UserInterfaceException;

class ErrorListener
{

	/**
	 * @var LoggerInterface
	 */
	private $logger;

	public function __construct(LoggerInterface $logger) {
		$this->logger = $logger;
	}

	public function onKernelException(GetResponseForExceptionEvent $event) {
		$exception = $event->getException();

		if ($exception instanceof ApiException) {

			$log_message = empty($exception->getPrevious()) ? $exception->getMessage() : $exception->getPrevious()->getMessage();

			$this->logger->error($log_message);

			$response = new JsonResponse(['message' => $exception->getMessage()], $exception->getCode());
			$event->setResponse($response);
		}
		elseif ($exception instanceof UserInterfaceException) {
			$event->setResponse(new RedirectResponse($exception->getPath()));
		}
	}

}