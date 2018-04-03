<?php
/**
 * Created by PhpStorm.
 * User: 111
 * Date: 2018/4/3
 * Time: 14:16
 */

//分段读取
swoole_async_read(__DIR__."/test.txt", function (string $filename, string $content){
    echo "filename: {$filename}" . PHP_EOL;
    echo "content: {$content}" . PHP_EOL;
}, 100);

//一次性读取, 最大4M
swoole_async_readfile(__DIR__."/test.txt", function (string $filename, string $content){

});
