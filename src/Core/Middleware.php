<?php

namespace App\Core;

abstract class Middleware
{
    abstract public function execute(array $params = []);
}