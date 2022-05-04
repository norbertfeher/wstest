<?php

namespace Webshippy;

require __DIR__.'/vendor/autoload.php';

use Webshippy\Controller;

$fileName = 'orders.csv';

$Controller = new Controller($argc, $argv, $fileName);
$Controller->run();
