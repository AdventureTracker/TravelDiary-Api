<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 18.03.2016
 * Time: 1:05
 */

namespace TravelDiary\ApiBundle\Exception;


class ApiException extends \Exception
{

	public function __construct($message, $code, $previous = null) {
		parent::__construct($message, $code, $previous);
	}

}