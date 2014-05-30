<?php

// Migrate Check Command
// Runs a test connection on all the defined systems, lets the user know if they worked or not.

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateCheckCommand extends Command {

    private $sDirPath = "./";

    protected function configure() {
        $this->setName("migrate:check");
		$this->setDescription("Check system connections");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
		$output->writeln("I will now run through every System and ensure it can connect");
		$list = scandir("./systems");
		$count = 0;
		foreach ($list as $fileName) {
			if (substr($fileName, -3) == "php") {
				$count++;
				$output->writeln(sprintf("Found: <info>%s</info>", $fileName));
				$this->runCheck($fileName);
			}
		}
		if ($count == 0) {
			$output->writeln("<error>No Systems Found</error>");
		}
    }

	

}
