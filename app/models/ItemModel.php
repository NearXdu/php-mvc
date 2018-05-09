<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 上午11:39
 */

namespace app\models;


use crlt\fastphp\base\Model;
use crlt\fastphp\db\Db;

class ItemModel extends Model
{
    public function search($keyword)
    {
        $query = 'SELECT * FROM `'.$this->table.'` WHERE `name` like :keyword';

        $sth = Db::pdo()->prepare($query);
        $sth = $this->formatParam($sth, [':keyword' => '%'.$keyword.'%']);
        $sth->execute();
        return $sth->fetchAll();
    }
}