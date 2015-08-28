<?php
    /**
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @copyright AnonymMedya, 2015
     */

    namespace Anonym\Components\Console;

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
        private $defaultCommands = [];
        /**
         * @param array $commands
         */
        public function __construct(array $commands = [])
        {
            if (count($commands) > 0) {
                $this->setCommands($commands);
            }

            $this->resolveSchedule();

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
