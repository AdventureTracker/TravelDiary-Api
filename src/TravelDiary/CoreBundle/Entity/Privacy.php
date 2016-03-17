<?php

namespace TravelDiary\CoreBundle\Entity;

/**
 * Privacy
 */
class Privacy
{
	/**
	 * @var integer
	 */
	private $idPrivacy;

	/**
	 * @var string
	 */
	private $prvCode;

	/**
	 * @var string
	 */
	private $prvDescription;


	/**
	 * Get idPrivacy
	 *
	 * @return integer
	 */
	public function getIdPrivacy()
	{
		return $this->idPrivacy;
	}

	/**
	 * Set prvCode
	 *
	 * @param string $prvCode
	 *
	 * @return Privacy
	 */
	public function setPrvCode($prvCode)
	{
		$this->prvCode = $prvCode;

		return $this;
	}

	/**
	 * Get prvCode
	 *
	 * @return string
	 */
	public function getPrvCode()
	{
		return $this->prvCode;
	}

	/**
	 * Set prvDescription
	 *
	 * @param string $prvDescription
	 *
	 * @return Privacy
	 */
	public function setPrvDescription($prvDescription)
	{
		$this->prvDescription = $prvDescription;

		return $this;
	}

	/**
	 * Get prvDescription
	 *
	 * @return string
	 */
	public function getPrvDescription()
	{
		return $this->prvDescription;
	}
}

