<?php
/**
 * Created by PhpStorm.
 * User: jakub
 * Date: 24.03.2016
 * Time: 11:44
 */

namespace TravelDiary\CoreBundle\Entity;


use Doctrine\ORM\EntityRepository;

class RecordRepository extends EntityRepository {

	public function countRecords() {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("COUNT(r)");
		$query->from("TravelDiaryCoreBundle:Record", 'r');
		return $query->getQuery()->getSingleScalarResult();
	}
	
	public function getRecordsByTripPaginated(Trip $trip, $page, $limit, $q = '') {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("record");
		$query->from("TravelDiaryCoreBundle:Record", "record");
		$query->join('record.idUser', 'user');
		$query->join('record.idRecordtype', 'recordType');
		$query->where("record.idTrip = :trip");
		$query->setParameter("trip", $trip);

		if (!empty($query)) {
			// SEARCH
			// Record owner concat
			$searchIn = $query->expr()->concat(
				"user.usrFirstname",
				$query->expr()->concat($query->expr()->literal(' '), "user.usrLastname")
			);

			// Record type concat
			$searchIn = $query->expr()->concat(
				$searchIn,
				$query->expr()->concat(
					$query->expr()->literal(';'),
					"recordType.retDescription"
				)
			);

			$searchIn = $query->expr()->concat(
				$searchIn,
				$query->expr()->concat(
					$query->expr()->literal(';'),
					"record.recDescription"
				)
			);

			$query->andWhere($query->expr()->like($searchIn, ":query"));
			$query->setParameter("query", sprintf("%%%s%%", $q));
		}

		$query->orderBy("record.recDay", "DESC");
		$query->setFirstResult(($page - 1) * $limit);
		$query->setMaxResults($limit);

		return $query->getQuery()->getResult();
	}


	/**
	 * @param Trip $trip
	 * @param $page
	 * @param $limit
	 * @param string $q
	 * @return int
	 */
	public function getRecordsByTripPaginatedCount(Trip $trip, $page, $limit, $q = '') {
		$query = $this->getEntityManager()->createQueryBuilder();
		$query->select("COUNT(record)");
		$query->from("TravelDiaryCoreBundle:Record", "record");
		$query->join('record.idUser', 'user');
		$query->join('record.idRecordtype', 'recordType');
		$query->where("record.idTrip = :trip");
		$query->setParameter("trip", $trip);

		if (!empty($query)) {
			// SEARCH
			// Record owner concat
			$searchIn = $query->expr()->concat(
				"user.usrFirstname",
				$query->expr()->concat($query->expr()->literal(' '), "user.usrLastname")
			);

			// Record type concat
			$searchIn = $query->expr()->concat(
				$searchIn,
				$query->expr()->concat(
					$query->expr()->literal(';'),
					"recordType.retDescription"
				)
			);

			$searchIn = $query->expr()->concat(
				$searchIn,
				$query->expr()->concat(
					$query->expr()->literal(';'),
					"record.recDescription"
				)
			);

			$query->andWhere($query->expr()->like($searchIn, ":query"));
			$query->setParameter("query", sprintf("%%%s%%", $q));
		}
		return $query->getQuery()->getSingleScalarResult();
	}





}