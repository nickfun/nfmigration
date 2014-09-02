<?php

/**
 * Entrypoint for the NFMigration application.
 * see http://github.com/nickfun/nfmigration
 */

require "vendor/autoload.php";

require "lib/MigrateNewCommand.php";
require "lib/MigrateRunCommand.php";
require "lib/MigrateInstallCommand.php";
require "lib/MigrateCheckCommand.php";
require "lib/MigrateNewSystemCommand.php";
require "lib/MigrationUtils.php";

use Symfony\Component\Console\Application;

$utils = new MigrationUtils();

$app = new Application();
$app->add(new MigrateNewCommand($utils));
$app->add(new MigrateNewSystemCommand($utils));
$app->add(new MigrateRunCommand($utils));
$app->add(new MigrateInstallCommand($utils));
$app->add(new MigrateCheckCommand($utils));
$app->run();
