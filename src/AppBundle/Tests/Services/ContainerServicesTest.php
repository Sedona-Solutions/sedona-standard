<?php

namespace Sedona\UMGIBackendBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\Exception\InactiveScopeException;

class ContainerServicesTest extends WebTestCase
{
    /**
     * List of services not to be checked.
     */
    protected function getBlackList()
    {
        return [
            'kernel',
            'web_profiler.controller.router',
            'cache_warmer',
            'doctrine.orm.default_entity_manager',
            'assetic.asset_manager',
            'assetic.controller',
            'security.secure_random',
            'security.context',
            'form.csrf_provider',
        ];
    }

    public function testContainerServices()
    {
        $client = static::createClient();
        /** @var Container $container */
        $container = $client->getContainer();

        foreach ($container->getServiceIds() as $serviceId) {
            try {
                if (!in_array($serviceId, $this->getBlackList())) {
                    $service = $client->getContainer()->get($serviceId);
                    $this->assertNotNull($service);
                }
            } catch (InactiveScopeException $e) {
            }
        }
    }
}
