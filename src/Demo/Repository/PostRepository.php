<?php

namespace Demo\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class PostRepository
 *
 * @package Demo\Repository
 */
class PostRepository extends EntityRepository implements PostRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function findAll(): array
    {
        return $this->createQueryBuilder('p')
            ->getQuery()
            ->getResult();
    }
}
