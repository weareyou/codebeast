<?php
namespace EugeneZenko\CodeBeast\Tools\PHPCS;

use EugeneZenko\CodeBeast\Tools\Tools;
use EugeneZenko\CodeBeast\Tools\Base;
use EugeneZenko\CodeBeast\Console\IOUtil;
use EugeneZenko\CodeBeast\Console\IO;

/**
 * Class PHPCS
 *
 * @package CodeBeast
 */
class PHPCS extends Base implements Tools {
    const TEMPLATE_PATH = '/Templates/PHPCS.template';
    const CANCEL_TEMPLATE_PATH = '/Templates/cancel.template';
    const CONSENT_TEMPLATE_PATH = '/Templates/consent.template';

    protected $template;

    public function __construct(IO $io)
    {
        $this->io = $io;
        $this->template = file_get_contents(dirname(__FILE__) . self::TEMPLATE_PATH);
    }

    public function configure() : string {
        $types = $this->io->ask('  <info>Comma-separated list of file extensions to evaluate with PHPCS</info> <comment>Example: php,theme,module,inc,install (leave empty to evaluate all)</comment> ', 'php,theme,module,inc,install');

        $exclude = $this->io->ask('  <info>Comma-separated list of directories to exclude</info> <comment>Example: custom,test (leave empty to evaluate all)</comment> ', '');

        $cancel = $this->io->ask('  <info>Force commit cancel in case of error?</info> <comment>[y,n]</comment> ', 'y');
        if (IOUtil::answerToBool($cancel)) {
            $action = file_get_contents(dirname(__FILE__) . self::CANCEL_TEMPLATE_PATH);
        } else {
            $action = file_get_contents(dirname(__FILE__) . self::CONSENT_TEMPLATE_PATH);
        }
        $this->template = str_replace('%action%', $action, $this->template);

        if (!empty(trim($types))) {
            $this->template = str_replace('%extensions%', '--extensions=' . trim($types), $this->template);
        } else {
            $this->template = str_replace('%extensions%', '', $this->template);
        }

        if (!empty(trim($exclude))) {
            $this->template = str_replace('%exclude%', '--ignore=' . trim($exclude), $this->template);
        } else {
            $this->template = str_replace('%exclude%', '', $this->template);
        }

        return $this->template;
    }
}
