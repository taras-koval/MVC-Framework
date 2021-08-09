<?php

use App\Core\App;
use Symfony\Component\Dotenv\Dotenv;

define('ROOT', dirname(__DIR__));
require ROOT.'/vendor/autoload.php';

(new Dotenv())->load(ROOT.'/.env');
(new App())->run();
