<?php
namespace EugeneZenko\CodeBeast\Tools\Lint;

use EugeneZenko\CodeBeast\Tools\Tools;
use EugeneZenko\CodeBeast\Tools\Base;
use EugeneZenko\CodeBeast\Console\IOUtil;
use EugeneZenko\CodeBeast\Console\IO;

/**
 * Class Lint
 *
 * @package CodeBeast
 */
class Lint extends Base implements Tools{

    const TEMPLATE_PATH = '/Templates/lint.template';

    protected $template;

    public function __construct(IO $io)
    {
        $this->io     = $io;
        $this->template = file_get_contents(dirname(__FILE__) . self::TEMPLATE_PATH);
    }

    public function configure() : string {
        $cancel = $this->io->ask('  <info>Force commit cancel in case of error?</info> <comment>[y,n]</comment> ', 'y');
        if (IOUtil::answerToBool($cancel)) {
            $action = $this->getForceCancelCode();
        } else {
            $action = $this->getConsentCode();
        }

        return str_replace('%action%', $action, $this->template);
    }
}
