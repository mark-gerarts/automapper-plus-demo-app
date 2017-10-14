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

    /**
     * @param Post $post
     * @return int
     *   The inserted ID.
     */
    public function insert(Post $post): int;

    /**
     * @param Post $post
     * @return void
     */
    public function update(Post $post): void;
}
