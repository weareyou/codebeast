<?php
namespace EugeneZenko\CodeBeast\Tools;

use EugeneZenko\CodeBeast\Console\IO;
use EugeneZenko\CodeBeast\Console\IOUtil;

/**
 * Class Base
 *
 * @package CodeBeast
 */
class Base
{

    /**
     * @var \EugeneZenko\CodeBeast\Console\IO
     */
    protected $io;

    /**
     * Consent template
     *
     * @var string
     */
    protected $consentCode;

    /**
     * Cancel template
     *
     * @var string
     */
    protected $cancelCode;

    /**
     * Installer constructor.
     *
     * @param \EugeneZenko\CodeBeast\Console\IO $io
     */
    public function __construct(IO $io)
    {
        $this->io     = $io;
        //$this->io->write('<info>File exists ' . $this->consentCode . '</info>');
    }

    public function getConsentCode() : string {
        $this->consentCode = file_get_contents(dirname(__FILE__) . '/../Templates/consent.template');
        return $this->consentCode;
    }

    public function getForceCancelCode() : string {
        $this->cancelCode = file_get_contents(dirname(__FILE__) . '/../Templates/cancel.template');
        return $this->cancelCode;
    }

    public function generalConfig() : string {
        $hook = '';

        $types = $this->io->ask('  <info>Comma-separated list of file extensions to run the full process on</info> <comment>Example (and default): php,theme,module,inc,install</comment> ', 'php,theme,module,inc,install');
        if (!empty(trim($types))) {
            $types = explode(',', trim($types));
            $types = array_map('trim', $types);
            $types = implode("\\|\\", $types);

            $hook = file_get_contents(dirname(__FILE__) . '/../Templates/hook.template');
            $hook = str_replace('%file_types%', $types, $hook);
        }

        return $hook;
    }

}