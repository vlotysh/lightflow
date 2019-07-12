<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/Core/functions.php';

use \App\Core\App;

define(APP_ROOT, __DIR__ . '/../');

$loader = new App();

$loader->run();