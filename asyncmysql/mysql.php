<?php
/**
 * Created by PhpStorm.
 * User: 111
 * Date: 2018/4/3
 * Time: 14:51
 */
class AsyncMysql {
    /**
     * @var null|swoole_mysql
     */
    public $db = null;

    public $dbConfig = array(
        'host' => '192.168.1.142',
        'port' => 3306,
        'user' => 'yang123',
        'password' => 'yang123',
        'database' => 'test',
        'charset' => 'utf8', //指定字符集
        'timeout' => 2,  // 可选：连接超时时间（非查询超时时间），默认为SW_MYSQL_CONNECT_TIMEOUT（1.0）
    );

    public function __construct(){
        $this->db = new swoole_mysql();
    }

    /**
     * @param $data
     * @throws \Swoole\Mysql\Exception
     */
    public function execute($data){
        $this->db->connect($this->dbConfig,  function (swoole_mysql $db, bool $result){
            if($result === false){
                var_dump($db->connect_error);
            }
            else{
                $sql = "select * from student";
                $db->query($sql, function (swoole_mysql $db, $result){
                    var_dump($result);
                    $db->close();
                });
            }
        });
    }
}

$asyncMysql = new AsyncMysql();
$asyncMysql->execute(null);
