<?php

namespace FondOfSpryker\Glue\OrdersRestApi;

use FondOfSpryker\Glue\OrdersRestApi\Processor\Order\OrderReader;
use Spryker\Glue\OrdersRestApi\Dependency\Client\OrdersRestApiToSalesClientInterface;
use Spryker\Glue\OrdersRestApi\OrdersRestApiFactory as SprykerOrdersRestApiFactory;
use Spryker\Glue\OrdersRestApi\Processor\Order\OrderReaderInterface;


class OrdersRestApiFactory extends SprykerOrdersRestApiFactory
{
    /**
     * @return \Spryker\Glue\OrdersRestApi\Processor\Order\OrderReaderInterface
     */
    public function createOrderReader(): OrderReaderInterface
    {
        return new OrderReader(
            $this->getSalesClient(),
            $this->getResourceBuilder(),
            $this->createOrderResourceMapper()
        );
    }

    /**
     * @return \Spryker\Glue\OrdersRestApi\Dependency\Client\OrdersRestApiToSalesClientInterface
     */
    public function getSalesClient(): OrdersRestApiToSalesClientInterface
    {
        return $this->getProvidedDependency(OrdersRestApiDependencyProvider::CLIENT_SALES);
    }
}
