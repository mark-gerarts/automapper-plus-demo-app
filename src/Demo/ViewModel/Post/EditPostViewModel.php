<?php

namespace Demo\ViewModel\Post;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EditPostViewModel
 *
 * @package Demo\ViewModel\Post
 */
class EditPostViewModel
{
    /**
     * @Assert\GreaterThan(0)
     */
    public $id;

    /**
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @Assert\NotBlank()
     */
    public $body;
}
