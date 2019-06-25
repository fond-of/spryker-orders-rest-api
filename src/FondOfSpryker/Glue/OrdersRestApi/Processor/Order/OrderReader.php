<?php

namespace FondOfSpryker\Glue\OrdersRestApi\Processor\Order;

use FondOfSpryker\Glue\OrdersRestApi\OrdersRestApiConfig;
use FondOfSpryker\Glue\OrdersRestApi\Processor\Order\OrderReaderInterface;
use Generated\Shared\Transfer\OrderListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\OrdersRestApi\Processor\Order\OrderReader as SprykerOrderReader;

class OrderReader extends SprykerOrderReader implements OrderReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getOrderAttributes(RestRequestInterface $restRequest): RestResponseInterface
    {

        if ($restRequest->getResource()->getId()) {
            return $this->getOrderDetailsResourceAttributes(
                $restRequest->getResource()->getId(),
                $restRequest->getUser()->getNaturalIdentifier()
            );
        }


        if ( $customerReference =
            $this->getRequestParameter($restRequest, OrdersRestApiConfig::QUERY_STRING_PARAMETER_CUSTOMER_REFERENCE)
        ) {
            $restResponse = $this->restResourceBuilder->createRestResponse();

            return $this->findOrderListAttributesByCustomerReference($restRequest, $customerReference);
        }

        

        return $this->getOrderListAttributes($restRequest);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param string $parameterName
     *
     * @return string
     */
    protected function getRequestParameter(RestRequestInterface $restRequest, string $parameterName): string
    {
        return $restRequest->getHttpRequest()->query->get($parameterName, '');
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function findOrderListAttributesByCustomerReference(RestRequestInterface $restRequest, string $customerReference): RestResponseInterface
    {
        $orderListTransfer = (new OrderListTransfer())->setCustomerReference($customerReference);
        $orderListTransfer = $this->salesClient->findOrdersByCustomerReference($orderListTransfer);

        $response = $this
            ->restResourceBuilder
            ->createRestResponse();

        foreach ($orderListTransfer->getOrders() as $orderTransfer) {

            $restOrdersAttributesTransfer = $this->orderResourceMapper->mapOrderTransferToRestOrdersAttributesTransfer($orderTransfer);

            $response = $response->addResource(
                $this->restResourceBuilder->createRestResource(
                    OrdersRestApiConfig::RESOURCE_ORDERS,
                    $orderTransfer->getIdSalesOrder(),
                    $restOrdersAttributesTransfer
                )
            );
        }

        return $response;
    }

    /**
     * @param string $orderReference
     *
     * @return \Generated\Shared\Transfer\InvoiceResponseTransfer
     */
    public function findInvoicesByCustomerReference(string $orderReference): InvoiceResponseTransfer
    {
        $invoiceTransfer = (new InvoiceTransfer())->setOrderReference($orderReference);

        return $this->invoiceClient->findInvoiceByOrderReference($invoiceTransfer);

    }
}
