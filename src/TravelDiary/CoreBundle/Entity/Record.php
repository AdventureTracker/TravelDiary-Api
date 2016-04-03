<?php

namespace TravelDiary\CoreBundle\Entity;
use CrEOF\Spatial\PHP\Types\Geometry\Point;

/**
 * Record
 */
class Record extends ApiEntity{
	/**
	 * @var integer
	 */
	private $idRecord;

	/**
	 * @var string
	 */
	private $recUUID;

	/**
	 * @var \DateTime
	 */
	private $recDay;

	/**
	 * @var string
	 */
	private $recDescription;

	/**
	 * @var Point
	 */
	private $recLocation;

	/**
	 * @var float
	 */
	private $recAltitude;

	/**
	 * @var \DateTime
	 */
	private $recCreatedAt;

	/**
	 * @var \DateTime
	 */
	private $recUpdatedAt;

	/**
	 * @var \Doctrine\Common\Collections\Collection
	 */
	private $photos;

	/**
	 * @var \TravelDiary\CoreBundle\Entity\Recordtype
	 */
	private $idRecordtype;

	/**
	 * @var \TravelDiary\CoreBundle\Entity\Trip
	 */
	private $idTrip;

	protected $required_fields = [
		'day',
		'status'
	];

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->photos = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get idRecord
	 *
	 * @return integer
	 */
	public function getIdRecord()
	{
		return $this->idRecord;
	}

	/**
	 * Set recUUID
	 *
	 * @param string $recUUID
	 *
	 * @return Record
	 */
	public function setRecUUID($recUUID)
	{
		$this->recUUID = $recUUID;

		return $this;
	}

	/**
	 * Get recUUID
	 *
	 * @return string
	 */
	public function getRecUUID()
	{
		return $this->recUUID;
	}

	/**
	 * Set recDay
	 *
	 * @param \DateTime|string $recDay
	 *
	 * @return Record
	 */
	public function setRecDay($recDay)
	{

		if (!($recDay instanceof \DateTime))
			$recDay = new \DateTime($recDay);

		$this->recDay = $recDay;

		return $this;
	}

	/**
	 * Get recDay
	 *
	 * @return \DateTime
	 */
	public function getRecDay()
	{
		return $this->recDay;
	}

	/**
	 * Set recDescription
	 *
	 * @param string $recDescription
	 *
	 * @return Record
	 */
	public function setRecDescription($recDescription)
	{
		$this->recDescription = $recDescription;

		return $this;
	}

	/**
	 * Get recDescription
	 *
	 * @return string
	 */
	public function getRecDescription()
	{
		return $this->recDescription;
	}

	/**
	 * @return Point
	 */
	public function getRecLocation()
	{
		return $this->recLocation;
	}

	/**
	 * @param Point $recLocation
	 */
	public function setRecLocation($recLocation)
	{
		$this->recLocation = $recLocation;
	}

	/**
	 * Set recAltitude
	 *
	 * @param float $recAltitude
	 *
	 * @return Record
	 */
	public function setRecAltitude($recAltitude)
	{
		$this->recAltitude = $recAltitude;

		return $this;
	}

	/**
	 * Get recAltitude
	 *
	 * @return float
	 */
	public function getRecAltitude()
	{
		return $this->recAltitude;
	}

	/**
	 * Set recCreatedAt
	 *
	 * @param \DateTime $recCreatedAt
	 *
	 * @return Record
	 */
	public function setRecCreatedAt($recCreatedAt)
	{
		$this->recCreatedAt = $recCreatedAt;

		return $this;
	}

	/**
	 * Get recCreatedAt
	 *
	 * @return \DateTime
	 */
	public function getRecCreatedAt()
	{
		return $this->recCreatedAt;
	}

	/**
	 * Set recUpdatedAt
	 *
	 * @param \DateTime $recUpdatedAt
	 *
	 * @return Record
	 */
	public function setRecUpdatedAt($recUpdatedAt)
	{
		$this->recUpdatedAt = $recUpdatedAt;

		return $this;
	}

	/**
	 * Get recUpdatedAt
	 *
	 * @return \DateTime
	 */
	public function getRecUpdatedAt()
	{
		return $this->recUpdatedAt;
	}

	/**
	 * Add photo
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Photo $photo
	 *
	 * @return Record
	 */
	public function addPhoto(\TravelDiary\CoreBundle\Entity\Photo $photo)
	{
		$this->photos[] = $photo;

		return $this;
	}

	/**
	 * Remove photo
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Photo $photo
	 */
	public function removePhoto(\TravelDiary\CoreBundle\Entity\Photo $photo)
	{
		$this->photos->removeElement($photo);
	}

	/**
	 * Get photos
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getPhotos()
	{
		return $this->photos;
	}

	/**
	 * Set idRecordtype
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Recordtype $idRecordtype
	 *
	 * @return Record
	 */
	public function setIdRecordtype(\TravelDiary\CoreBundle\Entity\Recordtype $idRecordtype = null)
	{
		$this->idRecordtype = $idRecordtype;

		return $this;
	}

	/**
	 * Get idRecordtype
	 *
	 * @return \TravelDiary\CoreBundle\Entity\Recordtype
	 */
	public function getIdRecordtype()
	{
		return $this->idRecordtype;
	}

	/**
	 * Set idTrip
	 *
	 * @param \TravelDiary\CoreBundle\Entity\Trip $idTrip
	 *
	 * @return Record
	 */
	public function setIdTrip(\TravelDiary\CoreBundle\Entity\Trip $idTrip = null)
	{
		$this->idTrip = $idTrip;

		return $this;
	}

	/**
	 * Get idTrip
	 *
	 * @return \TravelDiary\CoreBundle\Entity\Trip
	 */
	public function getIdTrip()
	{
		return $this->idTrip;
	}

	public function toArray($detailed = false)
	{
		$content = [
			'id' 			=> (string) $this->getRecUUID(),
			'type' 			=> (string) $this->idRecordtype->getRetCode(),
			'day' 			=> (string) $this->recDay->format("Y-m-d")
		];

		if ($detailed) {
			$content['description'] 		= (string) $this->recDescription;
			$content['coordinates'] 		= $this->getCoordinates();
			$content['photos'] 				= ApiEntity::prepare($this->photos->toArray());
		}

		return $content;
	}

	public function getCoordinates() {
		return [
			'latitude' 		=> (float) $this->getRecLocation()->getLatitude(),
			'longitude' 	=> (float) $this->getRecLocation()->getLongitude(),
			'altitude' 		=> (int) $this->getRecAltitude()
		];
	}
}

