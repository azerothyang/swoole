<?php
/**
 * Created by PhpStorm.
 * User: 111
 * Date: 2018/4/2
 * Time: 19:59
 */
//swoole_timer_tick(1000, function (int $timer_id, $params){
//    echo  "params: ";
//    var_dump($params);
//    echo "\n";
//    echo "timer_id: {$timer_id}\n";
//}, array(1,2,3,4));

// after定时器回调函数只有user_param参数
swoole_timer_after(1000, function ($user_param){
    echo  "params: ";
    var_dump($user_param);
    echo "\n";
//    echo "timer_id: {$timer_id}\n";
}, array(1,2,3,4));