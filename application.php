<?php

require "vendor/autoload.php";
require "GreetCommand.php";

use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new GreetCommand());
$app->run();
echo "Hello";