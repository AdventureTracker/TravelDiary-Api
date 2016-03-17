<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Recordtype
 */
class Recordtype
{
	/**
	 * @var integer
	 */
	private $idRecordtype;

	/**
	 * @var string
	 */
	private $retCode;

	/**
	 * @var string
	 */
	private $retDescription;


	/**
	 * Get idRecordtype
	 *
	 * @return integer
	 */
	public function getIdRecordtype()
	{
		return $this->idRecordtype;
	}

	/**
	 * Set retCode
	 *
	 * @param string $retCode
	 *
	 * @return Recordtype
	 */
	public function setRetCode($retCode)
	{
		$this->retCode = $retCode;

		return $this;
	}

	/**
	 * Get retCode
	 *
	 * @return string
	 */
	public function getRetCode()
	{
		return $this->retCode;
	}

	/**
	 * Set retDescription
	 *
	 * @param string $retDescription
	 *
	 * @return Recordtype
	 */
	public function setRetDescription($retDescription)
	{
		$this->retDescription = $retDescription;

		return $this;
	}

	/**
	 * Get retDescription
	 *
	 * @return string
	 */
	public function getRetDescription()
	{
		return $this->retDescription;
	}
	
}

