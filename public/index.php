<?php

use App\Core\App;
use Symfony\Component\Dotenv\Dotenv;

ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__DIR__));
require ROOT.'/vendor/autoload.php';
require ROOT.'/src/helpers.php';

(new Dotenv())->load(ROOT.'/.env');
(new App())->run();
