<?php

namespace Libs\Controllers;

use Config\ProjectSettings;
use Libs\Https\Request;
use Libs\Https\Response;

class Controller
{
    private ?Request $_request = null;

    public function __construct()
    {
        $this->_request = Request::instance();
    }

    public function run(string $_action, $_params = [])
    {
        if (!method_exists($this, $_action)) {
            return $this->render404('Page not found.');
        }

        return $this->$_action($_params);
    }

    protected function redirect(string $_uri): Response
    {
        return Response::redirect($_uri);
    }

    protected function render404(string $_message = 'Page not found.')
    {
        $_controller = ProjectSettings::NOT_FOUND_CONTROLLER;
        $_controller = new $_controller($_message);
        return $_controller->index([]);
    }
}
