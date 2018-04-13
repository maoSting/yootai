<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/10
 * Time: 15:16
 */

namespace Yootai;


use Yootai\Config\Config;
use Yootai\Tools\Auth;
use Yootai\Goods\YooGoods;
use Yootai\Order\YooOrder;

class Manager
{
    public static function action($config = [],$action = '', $data){
        $authTools = Auth::getInstance($config['key'], $config['secret']);
        $what = [];
        //获取sku list
        if($action == Config::METHOD_SKU_LIST) {
            $goodsObj = new YooGoods($authTools);
            if(isset($data['email'])) {
                $return = $goodsObj->getGoodsListByEmail($data['email'], $data['page'], $data['size']);
            } else {
                $return = $goodsObj->getGoodsList($data['page'], $data['size']);
            }
            $what = $return->json();
        } else if($action == Config::METHOD_SKU_GET){
            // 获取sku参数
            $goodsObj = new YooGoods($authTools);
            $return = $goodsObj->getSkuBySn($data);
            $what = $return->json();
        } else if($action == Config::METHOD_STOCK_GET){
            // 获取库存信息
            $goodsObj = new YooGoods($authTools);
            $return = $goodsObj->getStockBySn($data);
            $what = $return->json();
        } else if($action == Config::METHOD_ORDER_CREATE){
            $goodsObj = new YooOrder($authTools);
            $return = $goodsObj->create($data);
            $what = $return->json();
        } else if($action == Config::METHOD_ORDER_GET){
            $goodsObj = new YooOrder($authTools);
            $return = $goodsObj->get($data);
            $what = $return->json();
        } else if($action == Config::METHOD_ORDER_CANCEL){
            $goodsObj = new YooOrder($authTools);
            $return = $goodsObj->cancel($data);
            $what = $return->json();
        } else {
            $what = ['code' => 1, 'msg'=>'操作错误，请检查Manager::action的参数！'];
        }
        return $what;
    }


}