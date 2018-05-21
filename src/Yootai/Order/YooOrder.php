<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/10
 * Time: 9:17
 */

namespace Yootai\Order;


use Yootai\Config\Config;
use Yootai\Http\Client;
use Yootai\Tools\Auth;

class YooOrder
{


    public function __construct(Auth $auth)
    {
        $this->_auth = $auth;
    }

    /**
     * 创建订单
     * @param string $ordersJson order订单信息json字符串，字符串组成规则，详见文档
     * @return \Yootai\Http\Response
     * @author DQ
     */
    public function create($ordersJson = ''){
        $data = [];
        $data['method'] = Config::METHOD_ORDER_CREATE;
        $data['orders'] = $ordersJson;
        return Client::post($this->_auth->getHost(), $this->_auth->getParam($data));
    }


    /**
     * 订单获取
     * @param string $sn
     * @return \Yootai\Http\Response
     * @author DQ
     */
    public function get($sn = ''){
        $data = [];
        $data['method'] = Config::METHOD_ORDER_GET;
        $data['sn'] = $sn;
        return Client::post($this->_auth->getHost(), $this->_auth->getParam($data));
    }

    /**
     * 订单取消
     * @param string $snJson
     * @return \Yootai\Http\Response
     * @author DQ
     */
    public function cancel($snJson = ''){
        $data = [];
        $data['method'] = Config::METHOD_ORDER_CANCEL;
        $data['sn'] = $snJson;
        return Client::post($this->_auth->getHost(), $this->_auth->getParam($data));
    }

}