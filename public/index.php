<?php

use App\Core\App;
use Symfony\Component\Dotenv\Dotenv;

define('ROOT', strtr(dirname(__DIR__), '\\', '/'));

require ROOT.'/vendor/autoload.php';
require ROOT.'/src/helpers.php';

ini_set('display_errors', 0);
error_reporting(0);

if (config('app')['errors']) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

(new Dotenv())->load(ROOT.'/.env');
(new App())->run();
