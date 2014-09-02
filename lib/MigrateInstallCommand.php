<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateInstallCommand extends Command {

    private $sDirPath = "./migrations/";
    private $utils;

    public function __construct($utils) {
        $this->utils = $utils;
        parent::__construct();
    }

    protected function configure() {
        $this->setName("install")
                ->setDescription("Install NFMigrate on all systems")
                ->addArgument("system", InputArgument::OPTIONAL, "System to run on. Leave off to run on all systems");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $list = $this->utils->getSystemsList();
        foreach ($list as $system) {
            $output->writeln("System: $system");
        }
        $output->writeln("<error>Command not implemented yet :(</error>");
    }

}
