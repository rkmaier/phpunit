<?php

require "../vendor/autoload.php";

use app\Controllers\TestController;

$test = new TestController();
echo($test->hello());