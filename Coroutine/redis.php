<?php
/**
 * Created by PhpStorm.
 * User: 111
 * Date: 2018/4/3
 * Time: 18:16
 */
$http = new swoole_http_server('0.0.0.0', 9501);
$http->on('request', function (swoole_http_request $request, swoole_http_response $response){
    $coRedis = new Swoole\Coroutine\Redis();
    $coRedis->connect('127.0.0.1', 6379);
    $val = $coRedis->set("test", 999);
    $response->end($val);
});
$http->start();

