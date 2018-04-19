<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/9
 * Time: 9:16
 */

namespace Yootai\Tools;


class Auth
{
    private static $instance;
    private $_appKey = '';
    private $_appSecret = '';

    private function __construct($key = '', $sercret = '')
    {
        $this->_appKey = $key;
        $this->_appSecret = $sercret;
    }

    public static function getInstance($key = '', $secret = ''){
        if(!self::$instance){
            self::$instance = new self($key, $secret);
        }
        return self::$instance;
    }


    /**
     * 去掉为空value，key升序，MD5，十六进制大写
     * @todo 加密字段，文档说仅为空，需要确定空的范围0和字符串空
     * @param array $data
     * @param string $sha1
     * @author DQ
     */
    public function getSignValue($data = [], $sha1 = 'md5'){
        if (isset($data['sign'])) {
            unset($data['sign']);
        }
        $string = $this->_appSecret.$this->assemble($data).$this->_appSecret;
        $encrypt = '';
        if($sha1 == 'md5') {
            $encrypt = md5($string);
        }
        return strtoupper($encrypt);
    }

    /**
     * 对数组进行排序并拼接成字符串
     * @param $params
     * @return null|string
     * @author DQ
     */
    function assemble($params){
        if(!is_array($params)){
            return null;
        }

        ksort($params,SORT_STRING);
        $sign = '';
        foreach($params AS $key=>$val){
            if (!is_array($val) && trim($val) === '') {
                continue;
            }else if(!is_array($val)) {
                $sign .= $key . $val;
            }
        }
        return $sign;
    }


    /**
     * 拼凑公共参数
     * @param array $data
     * @return array
     * @author DQ
     */
    public function getParam($data = []){
        $data['type'] = 'normal';
        $data['app_key'] = $this->_appKey;
        $data['v'] = 1;
        $data['timestamp'] = time();
        $data['sign_method'] = 'md5';
        $sign = $this->getSignValue($data, 'md5');
        $data['sign'] = $sign;
        return $data;
    }

    /**
     * 验证数据是否合法
     * @param array $data
     * @return bool true 合法 false 不合法
     * @author DQ
     */
    public function validate($data = []){
        if($this->_appKey != $data['app_key']) {
            return false;
        }
        $sign = $data['sign'];
        unset($data['sign']);
        $validate = $this->getSignValue($data);
        if($sign != $validate){
            return false;
        }
        return true;
    }

}