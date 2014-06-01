<?php

/**
 * Entrypoint for the NFMigration application.
 * see http://github.com/nickfun/nfmigration
 */

require "vendor/autoload.php";

require "MigrateNewCommand.php";
require "MigrateRunCommand.php";
require "MigrateInstallCommand.php";
require "MigrateCheckCommand.php";
require "MigrateNewSystemCommand.php";

use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new MigrateNewCommand());
$app->add(new MigrateNewSystemCommand());
$app->add(new MigrateRunCommand());
$app->add(new MigrateInstallCommand());
$app->add(new MigrateCheckCommand());
$app->run();
