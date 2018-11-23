<?php
namespace EugeneZenko\CodeBeast\Tools\MD;

use EugeneZenko\CodeBeast\Tools\Tools;
use EugeneZenko\CodeBeast\Tools\Base;
use EugeneZenko\CodeBeast\Console\IOUtil;
use EugeneZenko\CodeBeast\Console\IO;

/**
 * Class MD
 *
 * @package CodeBeast
 */
class MD extends Base implements Tools {
    const TEMPLATE_PATH = '/Templates/MD.template';
    const CONFIG_PATH = '/Config/minimal.xml';

    protected $template;

    public function __construct(IO $io)
    {
        $this->io = $io;
        $this->template = file_get_contents(dirname(__FILE__) . self::TEMPLATE_PATH);
    }

    public function configure() : string {
        $types = $this->io->ask('  <info>Comma-separated list of file extensions to evaluate with MD</info> <comment>Example: php,theme,module,inc,install (leave empty to evaluate all)</comment> ', 'php,theme,module,inc,install');
        if (!empty(trim($types))) {
            $this->template = str_replace('%extensions%', '--suffixes ' . $types, $this->template);
        } else {
            $this->template = str_replace('%extensions%', '', $this->template);
        }

        $exclude = $this->io->ask('  <info>Comma-separated list of directories to exclude</info> <comment>Example: core,vendor (leave empty to evaluate all)</comment> ', '');
        if (!empty(trim($exclude))) {
            $this->template = str_replace('%exclude%', '--exclude ' . $exclude, $this->template);
        } else {
            $this->template = str_replace('%exclude%', '', $this->template);
        }

        $config = $this->io->ask('  <info>Path to MD config</info> <comment>Default is minimal.xml shipped with package</comment> ', '');
        if (empty(trim($config))) {
            $config = dirname(__FILE__) . self::CONFIG_PATH;
        }
        $this->template = str_replace('%config%', $config, $this->template);

        $cancel = $this->io->ask('  <info>Force commit cancel in case of error?</info> <comment>[y,n]</comment> ', 'y');
        if (IOUtil::answerToBool($cancel)) {
            $action = $this->getForceCancelCode();
        } else {
            $action = $this->getConsentCode();
        }
        $this->template = str_replace('%action%', $action, $this->template);

        return $this->template;
    }
}
