<?php
namespace EugeneZenko\CodeBeast\Console;

abstract class IOUtil
{
    /**
     * Convert a user answer to boolean.
     *
     * @param  string $answer
     * @return bool
     */
    public static function answerToBool($answer) : bool
    {
        return in_array($answer, ['y', 'yes', 'ok']);
    }

    /**
     * Return cli line separator string.
     *
     * @param  int $length
     * @return string
     */
    public static function getLineSeparator(int $length = 80)
    {
        return str_repeat('-', $length);
    }
}
