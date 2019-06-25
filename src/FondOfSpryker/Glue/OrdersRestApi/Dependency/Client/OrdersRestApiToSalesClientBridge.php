<?php

namespace FondOfSpryker\Glue\OrdersRestApi\Dependency\Client;

use Generated\Shared\Transfer\OrderListTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Spryker\Glue\OrdersRestApi\Dependency\Client\OrdersRestApiToSalesClientBridge as SprykerOrdersRestApiToSalesClientBridge;

class OrdersRestApiToSalesClientBridge extends SprykerOrdersRestApiToSalesClientBridge implements OrdersRestApiToSalesClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OrderTransfer
     */
    public function findOrdersByCustomerReference(OrderListTransfer $orderListTransfer): OrderListTransfer
    {
        return $this->salesClient->findOrdersByCustomerReference($orderListTransfer);
    }
}
