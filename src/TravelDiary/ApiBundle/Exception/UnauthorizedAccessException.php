<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 17.03.2016
 * Time: 13:56
 */

namespace TravelDiary\ApiBundle\Exception;


use Symfony\Component\HttpFoundation\JsonResponse;

class UnauthorizedAccessException extends \Exception
{

	public function __construct($message, \Exception $previous = null)
	{
		parent::__construct($message, 401, $previous);

		return new JsonResponse($message, $this->getCode());
	}

}