<?php
/**
 * Created by PhpStorm.
 * User: cheng
 * Date: 2018/3/25
 * Time: 22:28
 */
$client = new swoole_client(SWOOLE_SOCK_TCP);
if(!$client->connect('127.0.0.1', 9501)){
    echo "连接失败";
    exit();
}
fwrite(STDOUT, "请输入信息: ");
$msg = trim(fgets(STDIN));
$client->send($msg);
echo $client->recv();
$client->close();

