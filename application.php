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
require "MigrationUtils.php";

use Symfony\Component\Console\Application;

$utils = new MigrationUtils();

$app = new Application();
$app->add(new MigrateNewCommand($utils));
$app->add(new MigrateNewSystemCommand($utils));
$app->add(new MigrateRunCommand($utils));
$app->add(new MigrateInstallCommand($utils));
$app->add(new MigrateCheckCommand($utils));
$app->run();
