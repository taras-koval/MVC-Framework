<?php

use App\Core\App;
use Symfony\Component\Dotenv\Dotenv;

define('ROOT', strtr(dirname(__DIR__), '\\', '/'));

ini_set('display_errors', 0);
error_reporting(0);

if ((require ROOT.'/config/app.php')['errors']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require ROOT.'/vendor/autoload.php';
require ROOT.'/src/helpers.php';

(new Dotenv())->load(ROOT.'/.env');
(new App())->run();
