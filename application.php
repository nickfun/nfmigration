<?php

require "vendor/autoload.php";

require "GreetCommand.php";
require "MigrateNewCommand.php";

use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new GreetCommand());
$app->add(new MigrateNewCommand());
$app->run();
echo "Hello";