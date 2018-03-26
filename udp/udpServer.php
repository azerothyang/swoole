<?php
/**
 * Created by PhpStorm.
 * User: cheng
 * Date: 2018/3/25
 * Time: 18:46
 */
//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$serv->set(
    array(
        "reactor_num" => 4,
        "worker_num" => 4,
        "max_request" => 1000
    )
);

//监听数据接收事件
$serv->on('Packet', function (\swoole_server $serv, $data, $clientInfo) {
    $serv->sendto($clientInfo['address'], $clientInfo['port'], "Server ".$data);
//    var_dump($clientInfo);
});

//启动服务器
$serv->start();

