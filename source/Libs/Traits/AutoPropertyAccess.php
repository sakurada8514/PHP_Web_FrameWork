<?php

namespace Libs\Traits;

trait AutoPropertyAccess
{
    public function __call(string $_methodName, $_args)
    {
        if (!preg_match('~^(set|get)([A-Z])(.*)$~', $_methodName) && !method_exists($this, $_methodName))
            throw new \ErrorException('Method :' . $_methodName . ' not exists');

        if (preg_match('~^(set|get)([A-Z])(.*)$~', $_methodName, $_matches)) {
            $_property = '_' . strtolower($_matches[2]) . $_matches[3];

            if (!property_exists($this, $_property))
                throw new \ErrorException('Property :' . $_property . ' not exists');

            switch ($_matches[1]) {
                case 'set':
                    $this->_checkArguments($_args, 1, 1, $_methodName);
                    return $this->_set($_property, $_args[0]);
                case 'get':
                    $this->_checkArguments($_args, 0, 0, $_methodName);
                    return $this->_get($_property);
                default:
                    throw new \ErrorException('Method :' . $_methodName . ' not exists');
            }
        }
    }

    private function _get(string $_property)
    {
        return $this->$_property;
    }

    private function _set(string $_property, $_value): self
    {
        $this->$_property = $_value;
        return $this;
    }

    private function _checkArguments(array $args, int $_min, int $_max, string $_methodName): void
    {
        $_count = count($args);
        if ($_count < $_min || $_count > $_max) {
            throw new \ErrorException('Method ' . $_methodName . ' needs minimaly ' . $_min . ' and maximaly ' . $_max . ' arguments. ' . $_count . ' arguments given.');
        }
    }
}
