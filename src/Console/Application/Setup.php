<?php
namespace EugeneZenko\CodeBeast\Console\Application;

use EugeneZenko\CodeBeast\Console\Application;
use EugeneZenko\CodeBeast\Console\Command as Cmd;

class Setup extends Application
{
    /**
     * Initializes CodeBeast commands.
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    protected function getDefaultCommands()
    {
        return [
            new Cmd\Help(),
            new Cmd\Configuration(),
            new Cmd\Install(),
        ];
    }
}
