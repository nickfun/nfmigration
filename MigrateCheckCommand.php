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
    private $utils;

    public function __construct($utils) {
        $this->utils = $utils;
        parent::__construct();
    }

    protected function configure() {
        $this->setName("check");
        $this->setDescription("Check system connections");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->output = $output;
        $output->writeln("I will now run through every System and ensure it can connect");

        $list = $this->utils->getSystemsList();
        $count = count($list);
        foreach ($list as $system) {
            $pass = $this->runCheck($system);
            if ($pass) {
                $this->output->writeln("<info>PASS</info> $system");
            } else {
                $this->output->writeln("<error>FAIL</error> $system");
            }
        }

        if ($count == 0) {
            $output->writeln("<error>No Systems Found</error>");
        }
    }

    private function runCheck($className) {
        try {
            $obj = $this->utils->getSystem($className);
            $conns = $obj->getConnections();
            foreach ($conns as $conn) {
                if (!$obj->check($conn)) {
                    return false;
                }
            }
            return true;
        } catch (\Exception $e) {
            $this->output->writeln("<error>Exception!</error>\n" . $e->getMessage());
            return false;
        }
    }

}
