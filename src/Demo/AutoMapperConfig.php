<?php

namespace Demo;

use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use Demo\Model\Post;
use Demo\ViewModel\Post\CreatePostViewModel;
use Demo\ViewModel\Post\EditPostViewModel;
use Demo\ViewModel\Post\PostDetailViewModel;
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
     *
     * All the config in is put one file for convenience reasons. Alternatively,
     * you could create multiple class that implement the interface, and add the
     * tag in their service definitions.
     */
    public function configure(AutoMapperConfigInterface $config): void
    {
        // List view.
        $config
            ->registerMapping(Post::class, PostListViewModel::class)
            ->forMember('created', function (Post $source) {
                return $source->getCreated()->format('j F, Y');
            });

        // Detail view
        $config->registerMapping(Post::class, PostDetailViewModel::class)
            ->forMember('created', function (Post $source) {
                return $source->getCreated()->format('j F, Y');
            });

        // Create.
        $config->registerMapping(CreatePostViewModel::class, Post::class);

        // Update.
        $config
            ->registerMapping(Post::class, EditPostViewModel::class)
            ->reverseMap();
    }
}
