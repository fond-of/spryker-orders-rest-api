<?php

namespace FondOfSpryker\Glue\OrdersRestApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;
use Spryker\Glue\OrdersRestApi\OrdersRestApiConfig as SprykerOrdersRestApiConfig;

class OrdersRestApiConfig extends SprykerOrdersRestApiConfig
{
    public const QUERY_STRING_PARAMETER_CUSTOMER_REFERENCE = 'customer_reference';
    public const QUERY_STRING_PARAMETER_ORDER_REFERENCE = 'order_reference';
}
