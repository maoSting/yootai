<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/9
 * Time: 10:31
 */

namespace Yootai\Goods;
use Yootai\Http\Client;
use Yootai\Tools\Auth;
use Yootai\Config\Config;


class YooGoods
{
    private $_auth;

    public function __construct(Auth $auth)
    {
        $this->_auth = $auth;
    }

    public function getGoodsList($page = 1, $size = 0){
        $data['method'] = Config::METHOD_SKU_LIST;
        $data['page'] = $page;
        $data['size'] = $size;
        return Client::post($this->_auth->getHost(), $this->_auth->getParam($data));
    }

    public function getGoodsListByEmail($email = '', $page = 1, $size = 0){
        $data['method'] = Config::METHOD_SKU_LIST;
        $data['email'] = $email;
        $data['page'] = $page;
        $data['size'] = $size;
        return Client::post($this->_auth->getHost(), $this->_auth->getParam($data));
    }


    /**
     * 获取sku信息
     * @param string $snJson 商品货号sn数组组成 json字符串
     * @return \Yootai\Http\Response
     * @author DQ
     */
    public function getSkuBySn($snJson = ''){
        $param['method'] = Config::METHOD_SKU_GET;
        $param['sns'] = $snJson;
        return Client::post($this->_auth->getHost(), $this->_auth->getParam($param));
    }

    /**
     * 获取库存信息
     * @param string $snJson 商品货号sn数组组成 json字符串
     * @return \Yootai\Http\Response
     * @author DQ
     */
    public function getStockBySn($snJson = ''){
        $param['method'] = Config::METHOD_STOCK_GET;
        $param['sns'] = $snJson;
        return Client::post($this->_auth->getHost(), $this->_auth->getParam($param));
    }


}