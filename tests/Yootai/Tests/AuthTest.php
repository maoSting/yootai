<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/9
 * Time: 10:42
 */


namespace Yootai\Tests;
include "../Init.php";

class AuthTest extends \PHPUnit_Framework_TestCase
{
    public function testSign()
    {
        global $authTools;
        $sign = $authTools->getSignValue(['sns'=> ['1521516679476068', '1521357051130738']]);
        $this->assertEquals('3432616432343162323764623830356566626166626438343235376230323139', $sign);
    }

    public function testGetParam(){
        global $authTools;
        $param = $authTools->getParam(['test'=> '', 'one'=> 'two', 'two'=> 'one']);
        $this->assertEquals([

        ], $param);
    }







}
