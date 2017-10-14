<?php

namespace Demo\Repository;

use Demo\Model\Post;
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

    /**
     * @inheritdoc
     */
    public function insert(Post $post): int
    {
        $em = $this->getEntityManager();
        $em->persist($post);
        $em->flush();

        return $post->getId();
    }

    /**
     * @inheritdoc
     */
    public function update(Post $post): void
    {
        $post = $this->getEntityManager()->merge($post);
        $this->insert($post);
    }
}
