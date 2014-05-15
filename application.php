<?php

require "vendor/autoload.php";

require "GreetCommand.php";
require "MigrateNewCommand.php";
require "MigrateRunCommand.php";

use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new GreetCommand());
$app->add(new MigrateNewCommand());
$app->add(new MigrateRunCommand());
$app->run();
echo "Hello";