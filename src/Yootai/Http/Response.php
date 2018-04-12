<?php

namespace Yootai\Http;

/**
 * HTTP response Object
 */
final class Response
{
    public $statusCode;
    public $headers;
    public $body;
    public $error;
    private $jsonData;
    public $duration;

    /** @var array Mapping of status codes to reason phrases */
    private static $statusTexts = array(
        1 => 'error',
        25 => 'sign error',
    );

    /**
     * @param int $code 状态码
     * @param double $duration 请求时长
     * @param array $headers 响应头部
     * @param string $body 响应内容
     * @param string $error 错误描述
     */
    public function __construct($code, $duration, array $headers = array(), $body = null, $error = null)
    {
        $this->statusCode = $code;
        $this->duration = $duration;
        $this->headers = $headers;
        $this->body = $body;
        $this->error = $error;
        $this->jsonData = null;
        if ($error !== null) {
            return;
        }

        if ($body === null) {
            if ($code != 200) {
                $this->error = self::$statusTexts[$code];
            }
            return;
        }
        if (self::isJson($headers)) {
            $jsonData = self::bodyJson($body);
            if ($code != 200 && isset($jsonData['msg'])) {
                $this->error = $jsonData['msg'];
            }
            $this->jsonData = $jsonData;
        } elseif ($code > 0) {
            $this->error = $body;
        }
        return;
    }

    public function json()
    {
        return $this->jsonData;
    }

    private static function bodyJson($body)
    {
        return \json_decode((string) $body, true, 512);
    }

    public function xVia()
    {
        $via = $this->headers['X-Via'];
        if ($via === null) {
            $via = $this->headers['X-Px'];
        }
        if ($via === null) {
            $via = $this->headers['Fw-Via'];
        }
        return $via;
    }

    public function xLog()
    {
        return $this->headers['X-Log'];
    }

    public function xReqId()
    {
        return $this->headers['X-Reqid'];
    }

    public function ok()
    {
        return $this->statusCode >= 200 && $this->statusCode < 300 && $this->error === null;
    }

    public function needRetry()
    {
        $code = $this->statusCode;
        if ($code < 0 || ($code / 100 === 5 and $code !== 579) || $code === 996) {
            return true;
        }
    }

    private static function isJson($headers)
    {
        return array_key_exists('Content-Type', $headers) &&
        strpos($headers['Content-Type'], 'application/json') === 0;
    }
}
