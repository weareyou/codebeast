<?php
namespace EugeneZenko\CodeBeast\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use EugeneZenko\CodeBeast\Runner\Installer;

class Install extends Base
{
    /**
     * Configure the command.
     */
    protected function configure()
    {
        $this->setName('install')
             ->setDescription('Install git hooks')
             ->setHelp('This command will install the git hooks to your .git directory');
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

        $installer = new Installer($io);

        $installer->run();
    }
}
