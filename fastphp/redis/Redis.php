<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/9
 * Time: 下午8:23
 */

namespace crlt\fastphp\redis;

use InvalidArgumentException;
use Predis\Client;

class Redis
{
    protected static $redis;

    /**
     * redis init
     */
    public static function init()
    {
        self::$redis = new Client(array(['host' => REDIS_HOST, 'port' => REDIS_PORT]));
    }

    /**
     * @param $key
     * @param $value
     * @param null $time
     * @param null $unit
     */
    public static function set($key, $value, $time = null, $unit = null)
    {
        self::init();
        if ($time) {
            switch ($unit) {
                case 'h':
                    $time *= 3600;
                    break;
                case 'm':
                    $time *= 60;
                    break;
                case 's':
                case 'ms':
                    break;
                default:
                    throw new InvalidArgumentException('单位只能是 h m s ms');
                    break;
            }
            if ($unit == 'ms') {
                self::_psetex($key, $value, $time);

            } else {
                self::_setex($key, $value, $time);
            }
        } else {
            self::$redis->set($key, $value);
        }
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        self::init();
        return self::$redis->get($key);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function delete($key)
    {
        self::init();
        return self::$redis->del($key);
    }

    /**
     * @param $key
     * @param $value
     * @param $time
     */
    private static function _setex($key,$value,$time)
    {
        self::$redis->setex($key,$time,$value);
    }

    /**
     * @param $key
     * @param $value
     * @param $time
     */
    private static function _psetex($key,$value,$time)
    {
        self::$redis->psetex($key,$time,$value);
    }
}