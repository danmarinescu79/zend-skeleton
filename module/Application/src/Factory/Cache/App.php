<?php

/**
 * @Author: Dan Marinescu
 * @Date:   2017-11-06 13:15:55
 * @Email:  dan.marinescu79@icloud.com
 * @Last Modified by:   Dan Marinescu
 * @Last Modified time: 2017-11-06 13:16:52
 * @Last Modified email: dan.marinescu79@icloud.com
 */

namespace Application\Factory\Cache;

use Interop\Container\ContainerInterface;
use Zend\Cache\StorageFactory;
use Zend\ServiceManager\Factory\FactoryInterface;

class App implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return StorageFactory::factory([
            'adapter' => [
                'name'    => 'Memcached',
                'options' => [
                    'servers'   => [
                        [
                            '127.0.0.1', 11211
                        ]
                    ],
                    'namespace' => \Application\Module::APPLICATION,
                    'ttl'       => 300
                ],
            ],
            'plugins' => [
                [
                    'name'    => 'serializer',
                    'options' => []
                ],
                'exception_handler' => ['throw_exceptions' => false],
            ],
        ]);
    }
}
