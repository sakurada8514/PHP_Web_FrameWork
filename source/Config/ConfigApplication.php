<?php

namespace Config;

use Libs\Application;

class ConfigApplication implements Application
{
    public function ready()
    {
        echo 'Config Application is ready';
    }
}
