<?php
namespace EugeneZenko\CodeBeast\Runner;

use EugeneZenko\CodeBeast\Console\IOUtil;
use EugeneZenko\CodeBeast\Runner;
use EugeneZenko\CodeBeast\Tools\Base;

/**
 * Class Configurator
 *
 * @package CodeBeast
 */
class Configurator extends Runner
{
    /**
     * List of tools to be used in githook
     *
     * @var array
     */
    private $tools;

    /**
     * Contents of the hook
     *
     * @var string
     */
    private $hook;

    /**
     * Execute the configurator.
     *
     */
    public function run()
    {
        // TODO: pass configuration options
        if(0) {
            $list = file_get_contents(CODEBEAST_FOLDER . '/src/tools.json');
        } else {
            $list = file_get_contents(dirname(__FILE__) . '/../tools.default.json');
        }

        $this->tools = json_decode($list, true);

        if(!is_array($this->tools)) {
            $this->io->writeError('<info>Incorrect tools config.</info>');
            exit;
        }

        $this->configureHook();
        $this->writeConfig();

        $this->io->write(
            [
                '<info>Configuration created successfully</info>',
                'Run <comment>\'vendor/bin/codebeast install\'</comment> to activate your hook configuration',
            ]
        );

        $this->performInstall();
    }

    /**
     * Configure a hook.
     */
    public function configureHook()
    {
        $this->io->write('<info>General configuration</info>');
        $base = new Base($this->io);
        $this->hook = $base->generalConfig();

        $parts = [];
        foreach ($this->tools as $tool => $class) {
            $this->io->write('<info>Configuring ' . $tool . '</info>');
            try {
                $object = new $class($this->io);
                $parts[] = $object->configure();
            } catch (\Exception $exception) {
                $this->io->writeError('<info>Cannot create object of a class ' . $class . '</info>');
            }
        }

        $body = implode("\r\n", $parts);
        $this->hook = str_replace('%tools%', $body, $this->hook);
    }

    protected function writeConfig()
    {
        // TODO: ask to overwrite
        $this->hook = preg_replace('~(*BSR_ANYCRLF)\R~', "\n", $this->hook);

        $result = file_put_contents('pre-commit.settings', $this->hook);
        if ($result) {
            $this->io->write('<info>pre-commit.settings successfully written </info>');
        } else {
            $this->io->writeError('<info>Cannot write hook file, check directory permissions </info>');
            exit;
        }
    }

    protected function performInstall() {
        $install = $this->io->ask('  <info>Do you want to perform hook install?</info> <comment>[ y, n ]</comment> ', '');
        if (IOUtil::answerToBool($install)) {
            $installer = new Installer($this->io);
            $installer->run();
        }
    }
}
