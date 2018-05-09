<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 下午4:08
 */

namespace tools;

class ParseClassName
{
    /**
     * @param $name
     * @return array
     */
    public static function parse($name)
    {
        return array(
            'namespace' => array_slice(explode('\\', $name), 0, -1),
            'classname' => join('', array_slice(explode('\\', $name), -1)),
        );
    }

}