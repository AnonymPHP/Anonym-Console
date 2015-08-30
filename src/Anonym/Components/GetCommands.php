<?php
/**
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @copyright AnonymMedya, 2015
 */

namespace Anonym\Components\Console;

use Anonym\Components\Console\Schedule\ScheduleRunCommands;
use Anonym\Components\Cron\Cron;
use Console\System;
/**
 * Class CommandsManager
 * @package Anonym\Console
 */
class GetCommands extends System
{

    /**
     * the list of default console commands
     *
     * @var array
     */
    private $defaultCommands = [
        ScheduleRunCommands::class
    ];
    /**
     * @param array $commands
     */
    public function __construct(array $commands = [])
    {
        if (count($commands) > 0) {
            $this->setCommands($commands);
        }

        if (count($this->defaultCommands)) {
            $this->addDefaultCommands();
        }

        $this->resolveSchedule();

    }

    /**
     * add default commands to command reposity
     */
    private function addDefaultCommands()
    {
        foreach($this->defaultCommands as $command)
        {
            $this->addCommand($command);
        }
    }
    /**
     *  resolve the schude
     */
    private function resolveSchedule()
    {
        if(method_exists($this, 'schedule'))
        {
            call_user_func([$this, 'schedule'], new Cron());
        }
    }
    /**
     * @param array $commands
     * @return $this
     */
    public function setCommands(array $commands)
    {
        $this->commands = $commands;
        return $this;
    }

    /**
     * Yeni Komut ekler
     * @param string $command
     */
    public function addCommand($command = '')
    {
        $this->commands[] = $command;
    }

    /**
     * @return array
     */
    public function getCommands()
    {

        return $this->commands;
    }

}
