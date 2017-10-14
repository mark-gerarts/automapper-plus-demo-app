<?php

namespace Demo;

use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use Demo\Model\Post;
use Demo\ViewModel\Post\CreatePostViewModel;
use Demo\ViewModel\Post\PostListViewModel;

/**
 * Class AutoMapperConfig
 *
 * @package Demo
 */
class AutoMapperConfig implements AutoMapperConfiguratorInterface
{
    /**
     * @inheritdoc
     */
    public function configure(AutoMapperConfigInterface $config): void
    {
        $config->registerMapping(Post::class, PostListViewModel::class)
            ->forMember('created', function (Post $source) {
                return $source->getCreated()->format('j F, Y');
            });

        $config->registerMapping(CreatePostViewModel::class, Post::class);
    }
}
