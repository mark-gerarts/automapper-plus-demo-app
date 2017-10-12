<?php

namespace Demo;

use AutoMapperPlus\AutoMapperPlusBundle\AutoMapperConfiguratorInterface;
use AutoMapperPlus\Configuration\AutoMapperConfigInterface;
use Demo\Model\Employee\Employee;
use Demo\Model\Employee\EmployeeDto;

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
        $config->registerMapping(Employee::class, EmployeeDto::class)
            ->forMember('fullName', function (Employee $source) {
                return $source->getFirstName() . ' ' . $source->getLastName();
            });
    }
}
