<?php

// Migrate Check Command
// Runs a test connection on all the defined systems, lets the user know if they worked or not.

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateNewSystemCommand extends Command {

    private $sDirPath = "./";

    protected function configure() {
        $this->setName("newsystem");
        $this->setDescription("Check system connections");
        $this->addArgument("name", InputArgument::REQUIRED, "Name of the system you are creating");
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $name = $input->getArgument("name");
        $tpl = file_get_contents("template-system.php");
        $tpl = str_replace("$$$", $name, $tpl);
        $output->writeln("New System: <info>$name</info>");
        $fileName = "/systems/$name.php";
        file_put_contents($fileName, $tpl);
        $output->writeln("Filename: <info>$fileName</info>");
    }

}
