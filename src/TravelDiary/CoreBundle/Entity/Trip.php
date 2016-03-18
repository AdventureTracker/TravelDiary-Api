<?php

namespace TravelDiary\CoreBundle\Entity;
use Doctrine\Common\Collections\Collection;

/**
 * Trip
 */
class Trip
{
	/**
	 * @var integer
	 */
	private $idTrip;

	/**
	 * @var string
	 */
	private $trpUUID;

	/**
	 * @var string
	 */
	private $trpName;

	/**
	 * @var string
	 */
	private $trpDestination;

	/**
	 * @var string
	 */
	private $trpDescription;

	/**
	 * @var \DateTime
	 */
	private $trpStartDate;

	/**
	 * @var \DateTime
	 */
	private $trpEstimatedarrival;

	/**
	 * @var \DateTime
	 */
	private $trpCreatedAt = 'CURRENT_TIMESTAMP';

	/**
	 * @var \DateTime
	 */
	private $trpUpdatedAt = 'CURRENT_TIMESTAMP';

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $tripRecords;

	/**
	 * @var \TravelDiary\CoreBundle\Entity\Privacy
	 */
	private $idPrivacy;

	/**
	 * @var \TravelDiary\CoreBundle\Entity\Status
	 */
	private $idStatus;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $users;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->tripRecords = new \Doctrine\Common\Collections\ArrayCollection();
		$this->users = new \Doctrine\Common\Collections\ArrayCollection();

	}

	/**
	 * Get idTrip
	 *
	 * @return integer
	 */
	public function getIdTrip()
	{
		return $this->idTrip;
	}

	/**
	 * Set trpUUID
	 *
	 * @param string $trpUUID
	 *
	 * @return Trip
	 */
	public function setTrpUUID($trpUUID)
	{
		$this->trpUUID = $trpUUID;

		return $this;
	}

	/**
	 * Get trpUUID
	 *
	 * @return string
	 */
	public function getTrpUUID()
	{
		return $this->trpUUID;
	}

	/**
	 * Set trpName
	 *
	 * @param string $trpName
	 *
	 * @return Trip
	 */
	public function setTrpName($trpName)
	{
		$this->trpName = $trpName;

		return $this;
	}

	/**
	 * Get trpName
	 *
	 * @return string
	 */
	public function getTrpName()
	{
		return $this->trpName;
	}

	/**
	 * Set trpDestination
	 *
	 * @param string $trpDestination
	 *
	 * @return Trip
	 */
	public function setTrpDestination($trpDestination)
	{
		$this->trpDestination = $trpDestination;

		return $this;
	}

	/**
	 * Get trpDestination
	 *
	 * @return string
	 */
	public function getTrpDestination()
	{
		return $this->trpDestination;
	}

	/**
	 * Set trpDescription
	 *
	 * @param string $trpDescription
	 *
	 * @return Trip
	 */
	public function setTrpDescription($trpDescription)
	{
		$this->trpDescription = $trpDescription;

		return $this;
	}

	/**
	 * Get trpDescription
	 *
	 * @return string
	 */
	public function getTrpDescription()
	{
		return $this->trpDescription;
	}

	/**
	 * Set trpStartDate
	 *
	 * @param \DateTime $trpStartDate
	 *
	 * @return Trip
	 */
	public function setTrpStartDate($trpStartDate)
	{
		$this->trpStartDate = $trpStartDate;

		return $this;
	}

	/**
	 * Get trpStartDate
	 *
	 * @return \DateTime
	 */
	public function getTrpStartDate()
	{
		return $this->trpStartDate;
	}

	/**
	 * Set trpEstimatedarrival
	 *
	 * @param \DateTime $trpEstimatedarrival
	 *
	 * @return Trip
	 */
	public function setTrpEstimatedarrival($trpEstimatedarrival)
	{
		$this->trpEstimatedarrival = $trpEstimatedarrival;

		return $this;
	}

	/**
	 * Get trpEstimatedarrival
	 *
	 * @return \DateTime
	 */
	public function getTrpEstimatedarrival()
	{
		return $this->trpEstimatedarrival;
	}

	/**
	 * Set trpCreatedAt
	 *
	 * @param \DateTime $trpCreatedAt
	 *
	 * @return Trip
	 */
	public function setTrpCreatedAt($trpCreatedAt)
	{
		$this->trpCreatedAt = $trpCreatedAt;

		return $this;
	}

	/**
	 * Get trpCreatedAt
	 *
	 * @return \DateTime
	 */
	public function getTrpCreatedAt()
	{
		return $this->trpCreatedAt;
	}

	/**
	 * Set trpUpdatedAt
	 *
	 * @param \DateTime $trpUpdatedAt
	 *
	 * @return Trip
	 */
	public function setTrpUpdatedAt($trpUpdatedAt)
	{
		$this->trpUpdatedAt = $trpUpdatedAt;

		return $this;
	}

	/**
	 * Get trpUpdatedAt
	 *
	 * @return \DateTime
	 */
	public function getTrpUpdatedAt()
	{
		return $this->trpUpdatedAt;
	}

	/**
	 * Add tripRecord
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Record $tripRecord
	 *
	 * @return Trip
	 */
	public function addTripRecord(\TravelDiary\CoreBundle\Entity\Record $tripRecord)
	{
		$this->tripRecords[] = $tripRecord;

		return $this;
	}

	/**
	 * Remove tripRecord
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Record $tripRecord
	 */
	public function removeTripRecord(\TravelDiary\CoreBundle\Entity\Record $tripRecord)
	{
		$this->tripRecords->removeElement($tripRecord);
	}

	/**
	 * Get tripRecords
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getTripRecords()
	{
		return $this->tripRecords;
	}

	/**
	 * Set idPrivacy
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Privacy $idPrivacy
	 *
	 * @return Trip
	 */
	public function setIdPrivacy(\TravelDiary\CoreBundle\Entity\Privacy $idPrivacy = null)
	{
		$this->idPrivacy = $idPrivacy;

		return $this;
	}

	/**
	 * Get idPrivacy
	 *
	 * @return \TravelDiary\CoreBundle\Entity\Privacy
	 */
	public function getIdPrivacy()
	{
		return $this->idPrivacy;
	}

	/**
	 * Set idStatus
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Status $idStatus
	 *
	 * @return Trip
	 */
	public function setIdStatus(\TravelDiary\CoreBundle\Entity\Status $idStatus = null)
	{
		$this->idStatus = $idStatus;

		return $this;
	}

	/**
	 * Get idStatus
	 *
	 * @return \TravelDiary\CoreBundle\Entity\Status
	 */
	public function getIdStatus()
	{
		return $this->idStatus;
	}

	/**
	 * @return Collection
	 */
	public function getUsers()
	{
		return $this->users;
	}

	public function toArray($detailed = false) {
		$content = [
			'id' 							=> $this->trpUUID,
			'name' 							=> (string) $this->trpName,
			'destination' 					=> (string) $this->trpDestination,
			'description' 					=> (string) $this->trpDescription,
			'start_date' 					=> (string) $this->trpStartDate->format("Y-m-d-"),
			'estimated_arrival_date' 		=> (string) $this->trpEstimatedarrival->format("Y-m-d-"),
			'created_at' 					=> (string) $this->trpCreatedAt->format(\DateTime::ISO8601)
		];

		if ($detailed) {
			$content['records'] 			= [];
			foreach ($this->getTripRecords() as $tripRecord)
			{
				$content['records'][] 		= $tripRecord->toArray();
			}
		}

		return $content;
	}
}

