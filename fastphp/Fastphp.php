<?php

namespace crlt\fastphp;

/**
 * Class Fastphp
 * @package crlt\fastphp
 * core class
 */


use const CORE_PATH;
use function print_r;

require_once 'vendor/autoload.php';

defined('CORE_PATH') or define('CORE_PATH', __DIR__);

class Fastphp
{

    protected $config = [];

    /**
     * Fastphp constructor.
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * Load class
     * Check
     * Filter
     * Remove Global
     * Route
     */
    public function run()
    {
        //echo "run success".PHP_EOL;
        spl_autoload_register(array($this, 'loadClass'));
        $this->setRedisConfig();
        $this->setDbConfig();
        $this->route();
    }

    public function setRedisConfig()
    {
        if ($this->config['redis']) {
            define('REDIS_HOST', $this->config['redis']['host']);
            define('REDIS_PORT', $this->config['redis']['port']);
        }
    }

    /**
     * set database config paramerter
     */
    public function setDbConfig()
    {
        if ($this->config['db']) {
            define('DB_HOST', $this->config['db']['host']);
            define('DB_NAME', $this->config['db']['dbname']);
            define('DB_USER', $this->config['db']['username']);
            define('DB_PASS', $this->config['db']['password']);
        }
    }


    /**
     * route
     */
    public function route()
    {
        $controllerName = $this->config['defaultController'];
        $actionName = $this->config['defaultAction'];
        $param = array();
        $url = $_SERVER['REQUEST_URI'];

        //split url and parameter
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);
        $url = trim($url, '/');
        if ($url) {
            $urlArray = explode('/', $url);
            //space item
            $urlArray = array_filter($urlArray);

            //controller
            $controllerName = ucfirst($urlArray[0]);

            //action
            array_shift($urlArray);
            $actionName = $urlArray ? $urlArray[0] : $actionName;

            //parameter
            array_shift($urlArray);
            $param = $urlArray ? $urlArray : array();
            //print_r($param);
            //exit(-1);
        }

        //class name

        $controller = 'app\\controllers\\' . $controllerName . 'Controller';


        $actionName = 'action' . $actionName;



        if (!class_exists($controller)) {
            exit($controller . ' Controller not exist');
        }



        if (!method_exists($controller, $actionName)) {
            exit($actionName . ' Action not exist');
        }


        // Instance class
        $dispatch = new $controller($controllerName, $actionName);

        //$dispatch->actionName($param);
        call_user_func_array(array($dispatch, $actionName), $param);
    }

    public function loadClass($className)
    {
        $classMap = $this->classMap();

        if (isset($classMap[$className])) {

            $file = $classMap[$className];
        } elseif (strpos($className, '\\') !== false) {

            $file = APP_PATH . str_replace('\\', '/', $className) . '.php';

            if (!is_file($file)) {
                return;
            }

        } else {
            return;
        }
        include $file;
    }

    protected function classMap()
    {

        return [
            'crlt\fastphp\base\Controller' => CORE_PATH . '/base/Controller.php',
            'crlt\fastphp\base\Model' => CORE_PATH . '/base/Model.php',
            'crlt\fastphp\base\View' => CORE_PATH . '/base/View.php',
            'crlt\fastphp\db\Db' => CORE_PATH . '/db/Db.php',
            'crlt\fastphp\db\Sql' => CORE_PATH . '/db/Sql.php',
            'crlt\fastphp\redis\Redis' => CORE_PATH . '/redis/Redis.php',
            'crlt\tools\ParseClassName' => CORE_PATH . '/tools/ParseClassName.php',
        ];
    }

}

?>