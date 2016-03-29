<?php

namespace TravelDiary\CoreBundle\Entity;
use Doctrine\Common\Collections\Collection;

/**
 * Trip
 */
class Trip extends ApiEntity {
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
	private $trpEstimatedArrival;

	/**
	 * @var \DateTime
	 */
	private $trpCreatedAt;

	/**
	 * @var \DateTime
	 */
	private $trpUpdatedAt;

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

	protected $required_fields = [
		'name',
		'destination',
		'description',
		'estimated_arrival_date',
		'start_date',
		'id',
		'privacy',
		'status',
		'users'
	];

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
	 * @param \DateTime|string $trpStartDate
	 *
	 * @return Trip
	 */
	public function setTrpStartDate($trpStartDate)
	{

		if (!($trpStartDate instanceof \DateTime))
			$trpStartDate = new \DateTime($trpStartDate);

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
	 * Set trpEstimatedArrival
	 *
	 * @param \DateTime|string $trpEstimatedArrival
	 *
	 * @return Trip
	 */
	public function setTrpEstimatedArrival($trpEstimatedArrival)
	{
		
		if (!($trpEstimatedArrival instanceof \DateTime))
			$trpEstimatedArrival = new \DateTime($trpEstimatedArrival);
		
		$this->trpEstimatedArrival = $trpEstimatedArrival;

		return $this;
	}

	/**
	 * Get trpEstimatedArrival
	 *
	 * @return \DateTime
	 */
	public function getTrpEstimatedArrival()
	{
		return $this->trpEstimatedArrival;
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
	 * @param User $user
	 * @return $this
	 */
	public function addUser(User $user) {
		$this->users[] = $user;

		$user->addTrip($this);

		return $this;
	}

	/**
	 * @param User $user
	 */
	public function removeUser(User $user) {
		$this->users->removeElement($user);
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
			'id' 								=> (string) $this->trpUUID,
			'name' 								=> (string) $this->trpName,
			'destination' 						=> (string) $this->trpDestination,
			'status' 							=> (string) $this->getIdStatus()->getStaCode(),
			'privacy' 							=> (string) $this->getIdPrivacy()->getPrvCode()
		];

		if ($detailed) {
			$content['description'] 			= (string) $this->trpDescription;
			$content['start_date'] 				= (string) $this->trpStartDate->format("Y-m-d");
			$content['estimated_arrival_date'] 	= (string) $this->trpEstimatedArrival->format("Y-m-d");
			$content['records'] 				= ApiEntity::prepare($this->getTripRecords()->toArray());
			$content['users'] 					= ApiEntity::prepare($this->getUsers()->toArray());
			$content['created_at'] 				= (string) $this->trpCreatedAt->format(\DateTime::ISO8601);
			$content['updated_at'] 				= (string) $this->trpUpdatedAt->format(\DateTime::ISO8601);
		}

		return $content;
	}
}

