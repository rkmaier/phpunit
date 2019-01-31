<?php

require "vendor/autoload.php";

use Controllers\TestController;

$test = new TestController();
echo($test->index());