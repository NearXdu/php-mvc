<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/4/27
 * Time: 下午8:22
 */


use crlt\fastphp\Fastphp;

/**
 * Define app path
 */
define('APP_PATH',__DIR__.'/');

/**
 * Define debug mode
 */
define('APP_DEBUG',true);

/**
 * Core file
 */
require (APP_PATH.'fastphp/Fastphp.php');

/**
 * Config file
 */
$config =  require(APP_PATH.'config/config.php');

/**
 * Run App
 */
(new Fastphp($config))->run();