<?php
/**
 * Created by PhpStorm.
 * User: dingqiang
 * Date: 2018/4/11
 * Time: 15:46
 */
namespace Yootai\Tests;

use Yootai\Tools\Auth;

$key = 'BEST';
$secret = 'A69D7CAE';
$email = 'best';
$host = 'http://openapi.test.legovo.com';

$authTools = Auth::getInstance($key, $secret, $host);
