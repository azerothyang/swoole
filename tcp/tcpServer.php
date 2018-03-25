<?php
/**
 * Created by PhpStorm.
 * User: cheng
 * Date: 2018/3/25
 * Time: 18:46
 */
//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501);

$serv->set(
    array(
        "reactor_num" => 4,
        "worker_num" => 4,
        "max_request" => 1000
    )
);

//监听连接进入事件

$serv->on('connect', function ($serv, $fd, $reactor_id) {
    echo "Client: {$reactor_id} - {$fd} Connect.\n";
});

//监听数据接收事件
$serv->on('receive', function (\swoole_server $serv, $fd, $reactor_id, $data) {
    $serv->send($fd, "Server: {$reactor_id} - {$fd} ".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd, $reactor_id) {
    echo "Client: {$reactor_id} - {$fd} Close.\n";
});

//启动服务器
$serv->start();