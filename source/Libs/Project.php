<?php

namespace Libs;

use Libs\Controllers\Controller;
use Libs\Https\Request;
use TaskApp\Controllers\TaskController;

class Project
{
    private static ?Project $_instance = null;
    private ?Request $_request = null;

    public function __construct()
    {
        $this->_request = Request::instance();
    }

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Project();
        }

        return self::$_instance;
    }

    public function run()
    {
        list($_controller, $_action, $_params) = $this->_selectController();
        $res = $this->_actionController($_controller, $_action, $_params);
        $res->send();
    }

    private function _selectController()
    {
        $_controller = new TaskController();
        $_action = 'detail';
        $_params = ['id' => 100];

        return [$_controller, $_action, $_params];
    }

    private function _actionController(Controller $_controller, string $_action, array $_params)
    {
        return $_controller->run($_action, $_params);
    }
}
