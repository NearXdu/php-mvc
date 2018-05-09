<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/4/27
 * Time: 下午8:55
 */

$config['db']['host']='localhost';
$config['db']['username']='root';
$config['db']['password']='nightwatch';
$config['db']['dbname']='fastphp_db';

$config['redis']['host']='localhost';
$config['redis']['port']=6379;


$config['defaultController']='Hello';
$config['defaultAction']='index';

return $config;
