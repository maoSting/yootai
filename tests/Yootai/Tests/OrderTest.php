<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/10
 * Time: 16:23
 */

namespace Yootai\Tests;

use Yootai\Order\YooOrder;
include "../Init.php";

class OrderTest extends \PHPUnit_Framework_TestCase
{
    private $_sn;

    public function __construct()
    {
        $this->_sn = 'test_'.date("Y-m-d-H-i-s");
    }


    public function testCreate(){
        global $authTools;
        $goodsObj = new YooOrder($authTools);

        $order[] = [
            "sn" => $this->_sn,
            "subscriberName" => "丁强",
            "subscriberIdNo" => "341222198306094359",
            "receiverName" => "村花",
            "receiverMobile" => "18901326081",
            "receiverAddress" => "北京市朝阳区朝阳北路红装国际文化创新园",
            "skus" => [
                [
                    "sn" => "1521516679476068",
                    "sellPrice" => 20.55,
                    "count" => 2
                ]
            ]
        ];
        $orderJson = \json_encode($order);
        $data = $goodsObj->create($orderJson);
        $what = $data->json()['data'];

        foreach ($what as $item) {
            if($item['code'] != 0){
                var_dump($item['msg']);
            }
            $this->assertEquals(0, $item['code']);
        }
    }

    /**
     * @author DQ
     */
    public function testGet(){
        global $authTools;
        $orderObj = new YooOrder($authTools);
        $sn = $this->_sn;
        $data = $orderObj->get($sn);
        $this->assertEquals(0, $data->json()['code']);
    }



    public function testCancel() {
        global $authTools;
        $orderObj = new YooOrder($authTools);
        $sn = $this->_sn;
        $data = $orderObj->cancel($sn);
        $this->assertEquals(0, $data->json()['code']);
    }


}