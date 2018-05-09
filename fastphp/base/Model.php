<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 上午11:35
 */

namespace crlt\fastphp\base;


use function basename;
use crlt\fastphp\db\Sql;
use tools\ParseClassName;
use function get_class;

class Model extends Sql
{
    protected $model;

    public function __construct()
    {
        if (!$this->table) {
            $this->model = get_class($this);
            $ret=ParseClassName::parse($this->model);
            $this->model=$ret['classname'];
            $this->model = substr($this->model, 0, -5);

            $this->table = strtolower($this->model);
        }
    }
}