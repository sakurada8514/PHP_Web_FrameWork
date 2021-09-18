<?php

namespace Libs\Https;

class Request
{
    private static ?Request $_instance = null;
    private array $_headers = [];

    private function __construct()
    {
        $this->_headers = getallheaders();
    }

    public static function instance(): Request
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Request();
        }

        return self::$_instance;
    }

    public function methodType(): string
    {
        if (is_null($this->post('_method'))) {
            return $_SERVER['REQUEST_METHOD'];
        }

        return $this->post('_method');
    }

    public function get(string $_name, ?string $_default = null): ?string
    {
        if (isset($_GET[$_name])) {
            return $_GET[$_name];
        }
        return $_default;
    }

    public function post(string $_name, ?string $_default = null): ?string
    {
        if (isset($_POST[$_name])) {
            return $_POST[$_name];
        }
        return $_default;
    }

    public function header(?string $_name = null): string
    {
        if (is_null($_name)) {
            return getallheaders();
        }
        return $this->_headers[$_name] ? $this->_headers[$_name] : '';
    }

    public function host(): string
    {
        if ($_SERVER['HTTP_HOST']) {
            return $_SERVER['HTTP_HOST'];
        }
        return $_SERVER['SERVER_NAME'];
    }

    public function requestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    public function baseUrl(): string
    {
        $_scriptName = $_SERVER['SCRIPT_NAME'];
        $_requestUri = $this->requestUri();

        if (strpos($_requestUri, $_scriptName) === 0) {
            return $_scriptName;
        } else if (strpos($_requestUri, dirname($_scriptName)) === 0) {
            return rtrim(dirname($_scriptName));
        }
    }

    public function pathInfo(): string
    {
        $_baaseUrl = $this->baseUrl();
        $_requestUri = $this->requestUri();

        $pos = strpos($_requestUri, '?');
        if ($pos !== false) {
            $_requestUri = substr($_requestUri, 0, $pos);
        }
        $_pathInfo = (string)substr($_requestUri, strlen($_baaseUrl));

        return $_pathInfo;
    }
}
