<?php

namespace EugeneZenko\CodeBeast\Tools;

/**
 * Interface Tools
 *
 * @package CodeBeast
 */
interface Tools
{
    /**
     * Returns the part of git hook related to the tool
     *
     * @return string
     */
    public function configure();
}
