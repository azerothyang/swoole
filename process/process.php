<?php
/**
 * Created by PhpStorm.
 * User: cheng
 * Date: 2018/4/5
 * Time: 22:55
 */
$process = new swoole_process(function (swoole_process $process){
    echo 111;
}, true);
$pid = $process->start();
echo $pid . "\n";
//sleep(1);