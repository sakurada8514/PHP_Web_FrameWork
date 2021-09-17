<?php

namespace Libs\Utils;

class AutoLoader
{
    private string $_systemRootDir = '';
    private array  $_applicationsRootDir = [];

    public function __construct(string $_rootDir)
    {
        $this->_systemRootDir =  $_rootDir;
        $this->_applicationsRootDir = [$this->_systemRootDir];
    }

    public function run()
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    public function loadClass(string $_class)
    {
        $_file = $this->_createFilePath($_class);
        if (is_readable($_file)) {
            require_once $_file;
        }
    }

    private function _createFilePath(string $_class)
    {
        foreach ($this->_applicationsRootDir as $_dir) {
            $_pieces = [$_dir];
            $_classWithNameSpace = ltrim($_class, '\\');
            $_pieces = array_merge($_pieces, explode('\\', $_classWithNameSpace));
            $_result = implode(DIRECTORY_SEPARATOR, $_pieces) . '.php';
            if (is_readable($_result)) {
                return $_result;
            }
        }

        return null;
    }
}
