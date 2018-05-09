<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 上午9:38
 */

namespace crlt\fastphp\db;


use function implode;
use function is_int;
use function ltrim;
use PDOStatement;
use const PHP_EOL;
use function sprintf;

class Sql
{
    protected $table;
    protected $primary = 'id';

    private $filter = '';

    private $param = array();


    /**
     * @param array $where
     * @param array $param
     * @return $this
     */
    public function where($where = array(), $param = array())
    {
        if ($where) {
            $this->filter .= " WHERE ";
            $this->filter .= implode(' ', $where);
            $this->param = $param;
        }
        return $this;
    }

    /**
     * @param array $order
     * @return $this
     */
    public function order($order = array())
    {
        if ($order) {
            $this->filter .= " ORDER BY ";
            $this->filter .= implode(',', $order);
        }
        return $this;
    }

    /**
     * @return array
     */
    public function fetchAll()
    {
        $query = sprintf('SELECT * FROM `%s` %s', $this->table, $this->filter);

        $sth = Db::pdo()->prepare($query);

        $sth = $this->formatParam($sth, $this->param);

        $sth->execute();
        return $sth->fetchAll();
    }

    /**
     * @return mixed
     */
    public function fetch()
    {
        $query = sprintf('SELECT * from `%s` %s', $this->table, $this->filter);
        $sth = Db::pdo()->prepare($query);


        $sth = $this->formatParam($sth, $this->param);

        $sth->execute();
        return $sth->fetch();
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        $query=sprintf('DELETE FROM `%s` WHERE `%s` = :%s',$this->table,$this->primary,$this->primary);
        $sth = Db::pdo()->prepare($query);
        $sth=$this->formatParam($sth,[$this->primary=>$id]);
        $sth->execute();
        return $sth->rowCount();
    }

    /**
     * @param $data
     * @return int
     */
    public function add($data)
    {
        $query= sprintf('INSERT INTO `%s` %s', $this->table, $this->formatInsert($data));
        $sth=Db::pdo()->prepare($query);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();
        return $sth->rowCount();
    }

    /**
     * @param $data
     * @return int
     */
    public function update($data)
    {
        $query = sprintf("UPDATE `%s` SET %s %s", $this->table, $this->formatUpdate($data), $this->filter);
        $sth = Db::pdo()->prepare($query);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->rowCount();
    }
    /**
     * @param PDOStatement $sth
     * @param array $params
     * @return PDOStatement
     */
    public function formatParam(PDOStatement $sth, $params = array())
    {
        foreach ($params as $param => &$value) {
            $param = is_int($param) ? $param + 1 : ':' . ltrim($param, ':');
            $sth->bindParam($param, $value);
        }

        return $sth;
    }

    /**
     * @param $data
     * @return string
     */
    private function formatInsert($data)
    {
        $fields = array();
        $names = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s`", $key);
            $names[] = sprintf(":%s", $key);
        }

        $field = implode(',', $fields);
        $name = implode(',', $names);

        return sprintf("(%s) values (%s)", $field, $name);
    }

    /**
     * @param $data
     * @return string
     */
    private function formatUpdate($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("`%s` = :%s", $key, $key);
        }

        return implode(',', $fields);
    }

}