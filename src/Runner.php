<?php
namespace EugeneZenko\CodeBeast;

use EugeneZenko\CodeBeast\Console\IO;

/**
 * Class Runner
 *
 * @package CodeBeast
 */
abstract class Runner
{
    /**
     * @var \EugeneZenko\CodeBeast\Console\IO
     */
    protected $io;

    /**
     * Installer constructor.
     *
     * @param \EugeneZenko\CodeBeast\Console\IO $io
     */
    public function __construct(IO $io)
    {
        $this->io     = $io;
    }

    /**
     * Executes the Runner.
     */
    abstract public function run();
}
