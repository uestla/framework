<?php

namespace Kdyby\Doctrine\Repositories;

use Doctrine;
use Gedmo;
use Kdyby;
use Nette;



class NestedTreeRepository extends Gedmo\Tree\Entity\Repository\NestedTreeRepository
{

	/**
	 * Unefectively retrieves all the entities in tree
	 * NOTE: Fuck it for now, better that query for each entity
	 *
	 * @param int $id
	 * @param int|NULL $maxLevel
	 * @return Kdyby\Doctrine\Entities\NestedNode
	 */
	public function findTreeByRootId($id, $maxLevel = 0)
	{
		// prepare query
		$qb = $this->createQueryBuilder('n')
			->select('n', 'ch')
			->innerJoin('n.children', 'ch')
			->where('n.nodeRoot = :id');

		$qb->setParameter('id', $id);

		if ($maxLevel > 0) {
			$qb->andWhere('n.nodeLvl <= :lvl');
			$qb->andWhere('ch.nodeLvl <= :lvl');

			$qb->setParameter('lvl', $maxLevel);
		}

		// fetch result
		$qb->getQuery()->getResult();

		// returns already managed entity
		return $this->find($id);
	}

}