<?php
namespace Yootai\Config;

final class Config
{
    const SDK_VER = '0.0.1';

    // 接口参数
    const METHOD_SKU_LIST = 'open.distributor.sku.list';
    const METHOD_SKU_GET = 'open.sku.get';
    const METHOD_STOCK_GET = 'open.sku.stock.get';
    const METHOD_ORDER_CREATE = 'open.distributor.order.create';
    const METHOD_ORDER_GET = 'open.distributor.order.get';
    const METHOD_ORDER_CANCEL = 'open.distributor.order.cancel';
}
