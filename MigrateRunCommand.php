<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateRunCommand extends Command {

    private $sDirPath = "./migrations/";

    protected function configure() {
        $this->setName("run")
                ->setDescription("Run Migrations on a System")
                ->addArgument("system", InputArgument::REQUIRED, "System the migration will run against");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $system = $input->getArgument("system");
        $dirName = $this->sDirPath . $system;

        $output->writeln("Run Migrations <info>$system</info>");
        $output->writeln("Migrations are in $dirName");

        if (!file_exists($dirName)) {
            $output->writeln("<error>Can not open folder for $system</error>");
            return;
        }
        $dir = dir($dirName);
        while ($file = $dir->read()) {
            $output->writeln($file);
        }
    }

}
