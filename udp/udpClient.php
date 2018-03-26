<?php
/**
 * Created by PhpStorm.
 * User: cheng
 * Date: 2018/3/25
 * Time: 22:28
 */
$client = new swoole_client(SWOOLE_SOCK_UDP);
if(!$client->connect('127.0.0.1', 9501)){
    echo "连接失败";
    exit();
}
fwrite(STDOUT, "请输入信息: ");
$msg = trim(fgets(STDIN));
//$client->send($msg);
//echo $client->recv();
$i = 0;
while ($i < 10000000) {
    $client->send($i."\n");
//    $message = $client->recv();
//    echo "Get Message From Server:{$message}\n";
    $i++;
}
$client->close();


