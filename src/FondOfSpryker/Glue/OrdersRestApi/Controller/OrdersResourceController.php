<?php

namespace FondOfSpryker\Glue\OrdersRestApi\Controller;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\OrdersRestApi\Controller\OrdersResourceController as SprykerOrdersResourceController;

/**
 * @method \FondOfSpryker\Glue\OrdersRestApi\OrdersRestApiFactory getFactory()
 */
class OrdersResourceController extends SprykerOrdersResourceController
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getAction(RestRequestInterface $restRequest): RestResponseInterface
    {
        return $this->getFactory()->createOrderReader()->getOrderAttributes($restRequest);
    }
}
