<?php
namespace EugeneZenko\CodeBeast\Console\Command;

use EugeneZenko\CodeBeast\Config;
use EugeneZenko\CodeBeast\Console\IO;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Base
 *
 * @package CodeBeast
 */
class Base extends Command
{
    /**
     * Input output handler.
     *
     * @var \EugeneZenko\CodeBeast\Console\IO
     */
    private $io;

    /**
     * Codebeast configuration
     *
     * @var \EugeneZenko\CodeBeast\Config
     */
    private $config;

    /**
     * IO setter.
     *
     * @param \EugeneZenko\CodeBeast\Console\IO $io
     */
    public function setIO(IO $io)
    {
        $this->io = $io;
    }

    /**
     * IO interface getter.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface   $input
     * @param  \Symfony\Component\Console\Output\OutputInterface $output
     * @return \EugeneZenko\CodeBeast\Console\IO
     */
    public function getIO(InputInterface $input, OutputInterface $output)
    {
        if (null === $this->io) {
            $this->io = new IO\DefaultIO($input, $output, $this->getHelperSet());
        }
        return $this->io;
    }
}
