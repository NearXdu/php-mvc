<?php
namespace app\controllers;
use crlt\fastphp\base\Controller;
use crlt\fastphp\redis\Redis;


/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/4/27
 * Time: 下午10:45
 */
class HelloController extends Controller
{
    public function actionIndex()
    {
        echo "Hello World ZhangXiao".PHP_EOL;
        Redis::set('zhang','xiao');
    }

}