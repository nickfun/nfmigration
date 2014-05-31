<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateInstallCommand extends Command {

    private $sDirPath = "./migrations/";

    protected function configure() {
        $this->setName("install")
			->setDescription("Install NFMigrate on all systems");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
		$output->writeln("This will <info>install</info> the NFMigrate tables onto all systems.");
		$output->writeln("Is this correct?");
		$systems = ['HEAD','BODY','SYS','WAREHOUSE'];
		foreach ($systems as $name) {
			$output->writeln("\t$name");
		}
		
    }

}

