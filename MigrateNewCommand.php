<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateNewCommand extends Command {

    private $sDirPath = "./systems/";
    private $sTempalteFile = "./template-migration.php";
    private $utils;

    public function __construct($utils) {
        $this->utils = $utils;
        parent::__construct();
    }

    protected function configure() {
        $this->setName("new")
                ->setDescription("Create a new Migration")
                ->addArgument("system", InputArgument::REQUIRED, "System the migration will run against")
                ->addArgument("name", InputArgument::REQUIRED, "Name of the migration. No Spaces.");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $system = $input->getArgument("system");
        $name = $input->getArgument("name");

        if (!$this->isSystem($system)) {
            $output->writeln("<error>Invalid System:</error> $system");
            return;
        }
        if (!$this->isValidName($name)) {
            $output->writeln("<error>Invalid name:</error> $name");
            return;
        }

        $fileName = $this->makeNewMigration($system, $name);
        $output->writeln("System:\t$system");
        $output->writeln("Name:\t$name");
        $output->writeln("File:\t$fileName");
        $output->writeln("<info>OK!</info>");
    }

    private function isSystem($system) {
        $test = $this->sDirPath . $system;
        return file_exists($test);
    }

    private function isValidName($name) {
        if (strpos($name, " ") === false) {
            // good
        } else {
            return false;
        }

        return true;
    }

    public function makeNewMigration($system, $name) {
        $prefix = date('Ymd_His');
        $name = str_replace("-", "_", $name);
        $fileName = $this->sDirPath . $system . "/" . $prefix . "_" . $name . ".php";
        $className = $name . "_" . $prefix;

        $contents = file_get_contents($this->sTempalteFile);
        $contents = str_replace("TEMPLATE_MIGRAGION", $className, $contents);
        $fh = fopen($fileName, "w+");
        fwrite($fh, $contents);
        fclose($fh);
        return $fileName;
    }

}
