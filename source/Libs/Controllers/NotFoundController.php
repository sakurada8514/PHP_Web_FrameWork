<?php

namespace Libs\Controllers;

use Libs\Https\Response;
use Libs\Https\Status;

class NotFoundController extends Controller
{
    private string $_message = '';

    public function __construct(string $_message)
    {
        parent::__construct();
        $this->_message = $_message;
    }

    public function index(array $_params)
    {
        return new Response($this->_message, Status::HTTP_404_NOT_FOUND, Status::text(Status::HTTP_404_NOT_FOUND));
    }
}
