<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateRunCommand extends Command {

    private $sDirPath = "./systems/";
	private $utils;

	public function __construct($utils) {
		$this->utils = $utils;
	}

    protected function configure() {
        $this->setName("run")
                ->setDescription("Run Migrations on a System")
                ->addArgument("system", InputArgument::OPTIONAL, "System the migration will run against");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $this->input = $input;
        $this->output = $output;
        
        $system = $input->getArgument("system");
        if (empty($system)) {
            $system = false;
        }
        
        if (!$system) {
            $output->writeln("<info>Run ALL Systems!</info>");
            $list = $this->getSystemsList();
            if (empty($list)) {
                $output->writeln("<error>No Systems</error>");
            }
            foreach ($list as $sys) {
                $this->runMigrations($sys);
            }
        } else {
            $this->runMigrations($system);
        }

    }
    
    function runMigrations($systemName) {
        $this->output->writeln("Running system $systemName ...");
        
        $dir = "./systems/" . $systemName . "/";
        $d = dir($dir);
        while ($file = $d->read()) {
            if (substr($file, -4) == ".php") {
                $this->output->writeln("exec: " . $file);
            }
        }
    }

}
