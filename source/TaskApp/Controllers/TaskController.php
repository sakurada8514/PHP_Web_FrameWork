<?php

namespace TaskApp\Controllers;

use Libs\Controllers\Controller;
use Libs\Https\Response;

class TaskController extends Controller
{
    public function index(array $_params)
    {
        return new Response('This is index of task controller.');
    }

    public function detail(array $_params)
    {
        return new Response('This is index of task controller.' . $_params['id']);
    }
}
