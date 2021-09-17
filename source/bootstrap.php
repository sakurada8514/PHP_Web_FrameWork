<?php
require_once 'Libs/Utils/AutoLoader.php';
require_once 'Config/DirectorySettings.php';
require_once 'Config/ProjectSettings.php';

use Config\DirectorySettings;
use Config\ProjectSettings;
use Libs\Utils\AutoLoader;

if (ProjectSettings::IS_DEBUG) {
    ini_set('display_errors', 'On');
}

$autoLoader = new AutoLoader(DirectorySettings::APPLICATION_ROOT_DIR);
$autoLoader->run();

foreach (ProjectSettings::APPLICATIONS as $App) {
    $_app = new $App();
    $_app->ready();
}

$project = \Libs\Project::instance();
