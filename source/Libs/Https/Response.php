<?php

namespace Libs\Https;

use Libs\Traits\AutoPropertyAccess;

class Response
{
    use AutoPropertyAccess;

    private string $_content = '';
    private int $_statusCode = Status::HTTP_200_OK;
    private string $_statusText = '';
    private array $_httpHeaders = [];

    public function __construct(
        string $_content = '',
        int    $_statusCode = Status::HTTP_200_OK,
        string $_statusText = ''
    ) {
        $this->_content = $_content;
        $this->_statusCode = $_statusCode;
        $this->_statusText = $_statusText;
    }

    public function send()
    {
        header('HTTP/1.1 ' . $this->_statusCode . ' ' . $this->_statusText);

        foreach ($this->_httpHeaders as $name => $val) {
            header($name . ': ' . $val);
        }

        echo $this->_content;
    }

    public static function redirect($location)
    {
        $response = new self('', Status::HTTP_301_MOVED_PERMANENTLY, Status::text(Status::HTTP_301_MOVED_PERMANENTLY));
        $response->setHttpHeaders(['Location' => $location]);
        return $response;
    }
}
