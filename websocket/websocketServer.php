<?php
/**
 * Created by PhpStorm.
 * User: 111
 * Date: 2018/3/27
 * Time: 17:33
 */
class Ws {
    const IP = "0.0.0.0";
    const PORT = 9501;

    private $settings = array(
        "worker_num" => 4,
        "task_worker_num" => 4,
        "max_request" => 5000,
        "task_max_request" => 5000,
    );
    /**
     * @var null|swoole_websocket_server
     */
    public $server = null;

    public function __construct(){
        $this->server = new swoole_websocket_server(self::IP, self::PORT);
        $this->server->set($this->settings);
        $this->server->on("open", array($this, "onOpen"));
        $this->server->on("message", array($this, "onMessage"));
        $this->server->on("close", array($this, "onClose"));
        $this->server->on("request", array($this, "onRequest"));
        $this->server->on("task", array($this, "onTask"));
        $this->server->on("finish", array($this, "onFinish"));
        $this->server->start();
    }

    public function onOpen(swoole_websocket_server $server, $request){
        echo "server: handshake success with fd{$request->fd}\n";
    }

    public function onMessage(swoole_websocket_server $server, swoole_websocket_frame $frame){
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $server->push($frame->fd, "this is server");
    }

    public function onClose(swoole_websocket_server $server, $fd) {
        echo "client {$fd} closed\n";
    }

    public function onRequest(swoole_http_request $request, swoole_http_response $response){
        // $server->connections 遍历所有websocket连接用户的fd，给所有用户推送
        foreach ($this->server->connections as $fd) {
            $this->server->push($fd, $request->get['message']);
        }
        $response->end("ok");
    }

    public function onTask(swoole_server $server, int $task_id, int $src_worker_id, $data){
        echo "onTask:\n";
        print_r($data);
        sleep(10);
        return "task finish\n";
    }

    public function onFinish(swoole_server $server, int $task_id, string $data) {
        echo "onFinish:{$data}.\n";
    }
}
$ws = new Ws();
