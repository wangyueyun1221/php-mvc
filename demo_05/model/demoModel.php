<?php
/**
* demoModel
*/
class demoModel
{
    protected $_connect;
    protected $_table = 'db_demo';

    function __construct()
    {
        $config = [
            'host' => '127.0.0.1',
            'account' => 'root',
            'password' => '123456',
            'dbName' => 'demo',
            'charset' => 'utf8'
        ];
        $this->_connect = new mysqli($config['host'], $config['account'], $config['password'], $config['dbName']);
        if ($this->_connect->connect_error) {
            dd('数据库链接失败');
        }
        $this->_connect->set_charset($config['charset']);
    }

    public function getName($id)
    {
        $sql = sprintf('SELECT * FROM `%s` WHERE `id` = %d', $this->_table, $id);
        $res = $this->_connect->query($sql);
        if (!$res) {
            return '';
        }
        $result = [];
        while ($row = $res->fetch_object()) {
            $result[] = $row;
        }
        $row = reset($result);
        return $row->name;
    }

    public function getList()
    {
        $sql = sprintf('SELECT * FROM `%s`', $this->_table);
        $res = $this->_connect->query($sql);
        if (!$res) {
            return '';
        }
        $result = [];
        while ($row = $res->fetch_object()) {
            $result[] = $row;
        }
        return $result;
    }

    public function getUser($id)
    {
        $sql = sprintf('SELECT * FROM `%s` WHERE `id` = %d', $this->_table, $id);
        $res = $this->_connect->query($sql);
        if (!$res) {
            return '';
        }
        $result = [];
        while ($row = $res->fetch_object()) {
            $result[] = $row;
        }
        return reset($result);
    }

    public function update($id, array $params)
    {
        $sql = sprintf(
            'UPDATE `%s` SET `name` = "%s", `sex` = "%s", `age` = %d, `description` = "%s" WHERE `id` = %d',
            $this->_table,
            $params['name'],
            $params['sex'],
            $params['age'],
            $params['description'],
            $id
        );
        $res = $this->_connect->query($sql);
        return $res !== false;
    }

    public function remove($id)
    {
        $sql = sprintf('DELETE FROM `%s` WHERE `id` = %d', $this->_table, $id);
        $res = $this->_connect->query($sql);
        return $res !== false;
    }
}
