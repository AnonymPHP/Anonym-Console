<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\Console\Schedule;


use Anonym\Components\Console\Command;
use Anonym\Components\Console\HandleInterface;
use Anonym\Components\Cron\Cron;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;

class ScheduleRunCommands extends Command
{

    /**
     * signature of command
     *
     * @var string
     */
    protected $name = 'schedule:run';

    /**
     * description of command
     *
     * @var string
     */
    protected $description = 'Run the scheduled commands';

    /**
     * the instance of cron
     *
     * @var Cron
     */
    private $schedule;

    /**
     *
     */
    public function __construct()
    {
        $this->schedule = new Cron();
    }
    /**
     * Komut yakalandığı zaman tetiklenecek fonksiyonlardan biridir
     * @return mixed
     */
    public function handle()
    {


    }
}