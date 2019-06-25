<?php

namespace FondOfSpryker\Glue\OrdersRestApi;

use FondOfSpryker\Glue\OrdersRestApi\Dependency\Client\OrdersRestApiToSalesClientBridge;
use Spryker\Glue\Kernel\AbstractBundleDependencyProvider;
use Spryker\Glue\Kernel\Container;
use Spryker\Glue\OrdersRestApi\OrdersRestApiDependencyProvider as SprykerOrdersRestApiDependencyProvider;

/**
 * @method \Spryker\Glue\OrdersRestApi\OrdersRestApiConfig getConfig()
 */
class OrdersRestApiDependencyProvider extends SprykerOrdersRestApiDependencyProvider
{
    /**
     * @param \Spryker\Glue\Kernel\Container $container
     *
     * @return \Spryker\Glue\Kernel\Container
     */
    protected function addSalesClient(Container $container): Container
    {
        $container[static::CLIENT_SALES] = function (Container $container) {
            return new OrdersRestApiToSalesClientBridge($container->getLocator()->sales()->client());
        };

        return $container;
    }
}
