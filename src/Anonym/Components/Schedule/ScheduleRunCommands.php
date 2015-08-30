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

use Anonym\Components\Cron\EventReposity;
use Anonym\Components\Console\Command;
use Anonym\Components\Cron\Cron;

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
     * create a new instance and register schedule instance to $schedule variable
     */
    public function __construct()
    {
        parent::__construct();
        $this->schedule = new Cron();
    }
    /**
     * Komut yakalandığı zaman tetiklenecek fonksiyonlardan biridir
     * @return mixed
     */
    public function handle()
    {
        $schedule = $this->schedule;

        $events = $schedule->dueEvents(EventReposity::getEvents());

        if (!count($events)) {
            $this->error('There isnt any event from schedule');
            return false;
        }

        foreach($events as $event)
        {
            $event->execute();
        }

    }
}