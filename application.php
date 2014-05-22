<?php

require "vendor/autoload.php";

//require "GreetCommand.php";
require "MigrateNewCommand.php";
require "MigrateRunCommand.php";
require "MigrateInstallCommand.php";

use Symfony\Component\Console\Application;

$app = new Application();
//$app->add(new GreetCommand());
$app->add(new MigrateNewCommand());
$app->add(new MigrateRunCommand());
$app->add(new MigrateInstallCommand());
$app->run();
