<?php
/**
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @copyright AnonymMedya, 2015
 */

namespace Anonym\Components\Console;

use Anonym\Components\Console\Schedule\ScheduleCleanCommands;
use Symfony\Component\Console\Application as SymfonyConsole;
use Anonym\Components\Console\Schedule\ScheduleRunCommands;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\ArrayInput;
use Anonym\Components\Cron\EventReposity;
use Anonym\Components\Cron\Cron;
use Illuminate\Contracts\Container\Container;

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
    protected static $schedule;

    /**
     * an array for commands
     *
     * @var array
     */
    protected $commands = [];


    /**
     * the instance of laravel container
     *
     * @var Container
     */
    protected $container;

    /**
     * an array for default commands
     *
     * @var array
     */
    protected $kernel = [
        ScheduleRunCommands::class,
        ScheduleCleanCommands::class,
    ];

    /**
     * Sınıfı başlatır ve bazı atamaları gerçekleştirir
     * @param int $version
     */
    public function __construct(Container $container, $version = 1)
    {

        $this->setContainer($container);
        $this->runParentClass($version);
        static::$schedule = $schedule = new Cron();

        $this->resolveCommands();
        $this->schedule($schedule);
        static::$schedule->setCache(EventReposity::getEvents());


    }

    /**
     * execute parent class
     *
     * @param int $version
     */
    private function runParentClass($version)
    {
        $this->setAutoExit(false);
        $this->setCatchExceptions(true);

        // now we will register applicatio name and version,
        // application name by default is Anonym.
        parent::__construct('Anonym', $version);
    }

    /**
     * resolve the commands
     *
     */
    protected function resolveCommands()
    {
        $this->commands = $commands = array_merge($this->kernel, $this->commands);

        foreach ($commands as $command) {

            $command = $this->getContainer()->make($command)->setContainer($this->getContainer());
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
        $params['command'] = $command;
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


    /**
     * @return BufferedOutput
     */
    public function getLastOutput()
    {
        return $this->lastOutput;
    }

    /**
     * @param BufferedOutput $lastOutput
     * @return Kernel
     */
    public function setLastOutput($lastOutput)
    {
        $this->lastOutput = $lastOutput;
        return $this;
    }

    /**
     * @return array
     */
    public function getCommands()
    {
        return $this->commands;
    }

    /**
     * @param array $commands
     * @return Kernel
     */
    public function setCommands($commands)
    {
        $this->commands = $commands;
        return $this;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Container $container
     * @return Kernel
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @return array
     */
    public function getKernel()
    {
        return $this->kernel;
    }

    /**
     * @param array $kernel
     * @return Kernel
     */
    public function setKernel($kernel)
    {
        $this->kernel = $kernel;
        return $this;
    }


}
