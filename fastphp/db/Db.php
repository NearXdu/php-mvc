<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 上午9:57
 */

namespace crlt\fastphp\db;


use PDO;
use PDOException;
use function sprintf;

class Db
{
    private static $pdo = null;

    /**
     * Sigleton
     * @return null|PDO
     */
    public static function pdo()
    {
        if (self::$pdo !== null)
            return self::$pdo;

        try {
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB_HOST, DB_NAME);
            $option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
            return self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $option);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

}