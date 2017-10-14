<?php

namespace Demo\ViewModel\Post;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreatePostViewModel
 *
 * @package Demo\ViewModel\Post
 */
class CreatePostViewModel
{
    /**
     * @Assert\NotBlank()
     */
    public $title;

    /**
     * @Assert\NotBlank()
     */
    public $body;
}
