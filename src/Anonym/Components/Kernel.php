<?php
    /**
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @copyright AnonymMedya, 2015
     */

    namespace Anonym\Components\Console;
    use Symfony\Component\Console\Application as SymfonyConsole;
    use Symfony\Component\Console\Output\BufferedOutput;
    use Symfony\Component\Console\Input\ArrayInput;
    use Symfony\Component\Console\Input\InputOption;
    use Anonym\Components\Cron\Cron;

    /**
     * Class Console
     * @package Anonym\Components\Console
     */
    class Kernel extends SymfonyConsole
    {

        /**
         * @var BufferedOutput
         */
        private $lastOutput;


        /**
         * the instance of cron
         *
         * @var Cron
         */
        private static $schedule;

        /**
         * an array for commands
         *
         * @var array
         */
        protected $commands;


        /**
         * an array for default commands
         *
         * @var array
         */
        protected $kernel;
        /**
         * Sınıfı başlatır ve bazı atamaları gerçekleştirir
         * @param int $version
         */
        public function __construct($version = 1)
        {

            $this->setAutoExit(false);
            $this->setCatchExceptions(false);
            $this->resolveCommands();
            static::$schedule = $schedule = new Cron();
            $this->schedule($schedule);

            parent::__construct('AnonymFrameworkConsole', $version);
        }


        /**
         * resolve the commands
         *
         */
        protected function resolveCommands()
        {
            $this->commands = $commands = array_merge($this->kernel, $this->commands);

            foreach ($commands as $command) {
                $command = new $command();
                $this->addToParent($command);
            }
        }


        /**
         * Komutu yürütür
         * @param $command
         * @param array $params
         * @return int
         * @throws \Exception
         */
        public function call($command, array $params = [])
        {
            $params['commands'] = $params;
            $this->lastOutput = new BufferedOutput();
            return $this->find($command)->run(new ArrayInput($params), $this->lastOutput);
        }

        /**
         * Girilen Komutu sınıfa ekler
         * @param Command $command
         */
        public function addToParent(Command $command)
        {
            $this->add($command);
        }

        /**
         * Çıktıyı döndürür
         * @return string
         */
        public function output()
        {
            return isset($this->lastOutput) ? $this->lastOutput->fetch() : '';
        }

        /**
         * Get the default input definitions for the Anonyms.
         *
         * This is used to add the --env option to every available command.
         *
         * @return \Symfony\Component\Console\Input\InputDefinition
         */
        protected function getDefaultInputDefinition()
        {
            $definition = parent::getDefaultInputDefinition();
            $definition->addOption($this->getEnvironmentOption());
            return $definition;
        }

        /**
         * Get the global environment option for the definition.
         *
         * @return \Symfony\Component\Console\Input\InputOption
         */
        protected function getEnvironmentOption()
        {
            $message = 'The environment the command should run under.';
            return new InputOption('--env', null, InputOption::VALUE_OPTIONAL, $message);
        }

    }
