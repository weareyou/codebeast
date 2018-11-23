<?php
namespace EugeneZenko\CodeBeast\Console\Command;

use EugeneZenko\CodeBeast\Runner\Configurator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Config
 *
 * @package CodeBeast
 */
class Configuration extends Base
{
    /**
     * Configure the command.
     */
    protected function configure()
    {
        $this->setName('configure')
             ->setDescription('Configures the git hook for future generation')
             ->setHelp('This command creates settings file which is used for git hook file generation');
    }

    /**
     * Execute the command.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface   $input
     * @param  \Symfony\Component\Console\Output\OutputInterface $output
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io     = $this->getIO($input, $output);

        $configurator = new Configurator($io);
        $configurator->run();
    }
}
