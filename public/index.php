<?php

use App\Core\App;

define('ROOT', dirname(__DIR__));

require ROOT . '/vendor/autoload.php';

$app = new App();
$app->run();
