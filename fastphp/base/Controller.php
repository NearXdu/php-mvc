<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/4/27
 * Time: 下午10:31
 */

namespace crlt\fastphp\base;


class Controller
{
    protected $_controller;
    protected $_action;
    protected $_view;

    /**
     * Controller constructor.
     * @param $controller
     * @param $action
     */
    public function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_view = new View($controller, $action);
    }

    /**
     * @param $name
     * @param $value
     * Assign Key-Value pair to View layer
     */
    public function assign($name,$value)
    {
        $this->_view->assign($name,$value);
    }

    /**
     * Render file
     */
    public function render()
    {
        $this->_view->render();
    }


}