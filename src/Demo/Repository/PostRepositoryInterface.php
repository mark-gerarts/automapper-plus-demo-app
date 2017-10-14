<?php

namespace Demo\Repository;

use Demo\Model\Post;

/**
 * Interface PostRepositoryInterface
 *
 * @package Demo\Repository
 */
interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function findAll(): array;
}
