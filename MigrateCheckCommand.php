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
        $this->setName("check");
        $this->setDescription("Check system connections");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->output = $output;
        $output->writeln("I will now run through every System and ensure it can connect");
        $list = scandir("./systems");
        $count = 0;
        foreach ($list as $fileName) {
            if (substr($fileName, -4) == ".php") {
                $class = substr($fileName, 0, -4);
                $count++;
                // $output->writeln(sprintf("Found: <info>%s</info>", $class));
                $this->runCheck($class);
            }
        }
        if ($count == 0) {
            $output->writeln("<error>No Systems Found</error>");
        }
    }

    private function runCheck($className) {
        require "./systems/$className" . ".php";
        $temp = new $className();
        if ($temp->check()) {
            $this->output->writeln("$className <info>PASS</info>");
        } else {
            $this->output->writeln("$className <error>FAIL</error>");
        }
    }

}
