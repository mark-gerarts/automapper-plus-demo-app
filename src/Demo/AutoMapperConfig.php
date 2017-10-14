<?php

namespace Demo;

use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use Demo\Model\Post;
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
        $config->registerMapping(Post::class, PostListViewModel::class);
    }
}
