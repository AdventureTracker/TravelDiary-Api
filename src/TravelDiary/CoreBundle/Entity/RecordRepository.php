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
		return $query->getQuery()->getScalarResult();
	}

}