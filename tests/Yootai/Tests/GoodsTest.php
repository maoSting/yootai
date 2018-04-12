<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/9
 * Time: 14:32
 */

namespace Yootai\Tests;


use Yootai\Goods\YooGoods;
include "../Init.php";

class GoodsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetGoodsList(){
        global $authTools;
        $goodsObj = new YooGoods($authTools);
        $data = $goodsObj->getGoodsList(1,10);
		var_dump($data);
        $this->assertEquals(0, $data->json()['code']);
    }

    public function testGetGoodsListByEmail(){
        global $authTools, $email;
        $goodsObj = new YooGoods($authTools);
        $data = $goodsObj->getGoodsListByEmail($email, 1, 10);
        $this->assertEquals(0, $data->json()['code']);
    }

    public function testGetSkuBySn(){
        global $authTools;
        $goodsObj = new YooGoods($authTools);
        $snJson = \json_encode(['1521516679476068', '1521357051130738']);
        $data = $goodsObj->getSkuBySn($snJson);
        $this->assertEquals(0, $data->json()['code']);
    }

    public function testGetStockBySn(){
        global $authTools;
        $goodsObj = new YooGoods($authTools);
        $snJson = \json_encode(['1521516679476068', '1521357051130738']);
        $data = $goodsObj->getStockBySn($snJson);
        $this->assertEquals(0, $data->json()['code']);
    }



}