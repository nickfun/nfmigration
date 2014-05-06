<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateNewCommand extends Command {

    private $sDirPath = "./";

    protected function configure() {
        $this->setName("migrate:new")
                ->setDescription("Create a new Migration")
                ->addArgument("system", InputArgument::REQUIRED, "System the migration will run against")
                ->addArgument("name", InputArgument::REQUIRED, "Name of the migration. No Spaces.");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $system = $input->getArgument("system");
        $name = $input->getArgument("name");
        if (strpos($name, " ") > 0 ) {
            $output->writeln("<error>ERROR</error> name can not have spaces.");
            $output->writeln("A migration was NOT created");
            return;
        }
        $prefix = date('Ymd_His') . '_';
        $file = sprintf("/migrations/%s/%s", $system, $prefix . $name . '.php');
        $output->writeln("System:\t$system");
        $output->writeln("Name:\t$name");
        $output->writeln("File:\t$file");
        $output->writeln("OK!");
    }

}
