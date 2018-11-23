<?php
namespace EugeneZenko\CodeBeast\Console;

use EugeneZenko\CodeBeast\CB;
use Symfony\Component\Console\Application as SymfonyApplication;

class Application extends SymfonyApplication
{
    /**
     * @var \EugeneZenko\CodeBeast\Config
     */
    protected $config;

    /**
     * Input output interface
     *
     * @var \EugeneZenko\CodeBeast\Console\IO
     */
    protected $io;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        if (function_exists('ini_set') && extension_loaded('xdebug')) {
            ini_set('xdebug.show_exception_trace', false);
            ini_set('xdebug.scream', false);
        }
        parent::__construct('CodeBeast', CB::VERSION);

        $this->setDefaultCommand('help');
    }

    /**
     * Append release date to version output.
     *
     * @return string
     */
    public function getLongVersion()
    {
        return sprintf(
            '<info>%s</info> version <comment>%s</comment> %s',
            $this->getName(),
            $this->getVersion(),
            CB::RELEASE_DATE
        );
    }
}
