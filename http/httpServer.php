<?php
$server = new swoole_http_server("0.0.0.0", 9501);
$server->on("request", function (swoole_http_request $request, swoole_http_response $response){
    var_dump($request->post);
    var_dump($request->server);
    $response->header('Server', 'qhdata_server');
//    $response->write("hello http");
    $response->end("hello world");
});
$server->start();