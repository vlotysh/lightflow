<?php

require __DIR__.'/../vendor/autoload.php';
require __DIR__ . '/../core/functions.php';

use \Core\App;

define(APP_ROOT, __DIR__ . '/../');

$loader = new App();

$loader->run();