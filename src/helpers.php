<?php

use App\Core\App;
use App\Core\Database;
use App\Core\Session;

function db(): Database
{
    return App::$database;
}

function session(): Session
{
    return App::$session;
}