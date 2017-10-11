<?php

namespace AutoMapperPlus\AutoMapperPlusBundle;

use AutoMapperPlus\Configuration\AutoMapperConfigInterface;

// @todo: figure out a better name..
interface AutoMapperConfiguratorInterface
{
    public function configure(AutoMapperConfigInterface $config): void;
}
