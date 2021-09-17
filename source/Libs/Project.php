<?php

namespace Libs;

class Project
{
    private static ?Project $_instance = null;

    private function __construct()
    {
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
        echo 'Project is running';
    }
}
