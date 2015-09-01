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

use Anonym\Components\Cron\Cron as Schedule;
use Anonym\Components\Cron\EventReposity;
use Anonym\Components\Console\Command;
use Anonym\Components\Cron\Task\Task;
use Anonym\Components\Cron\Task\TaskReposity;

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
     * @var Schedule
     */
    protected $schedule;

    /**
     * create a new instance and register schedule instance to $schedule variable
     */
    public function __construct(Schedule $schedule = null)
    {
        $this->schedule = $schedule;
        $this->schedule->install(Task::console('schedule:run'));
        parent::__construct();
    }

    /**
     * Komut yakalandığı zaman tetiklenecek fonksiyonlardan biridir
     * @return mixed
     */
    public function fire()
    {
        $schedule = $this->schedule;

        $events = $schedule->dueEvents($schedule->getEvents());

        if (!count($events)) {
            $this->error('There isnt any event from schedule');

            return false;
        }

        foreach ($events as $event) {

            if ($event instanceof TaskReposity) {
                $this->info(sprintf('%s Command is Runnig', $event->getCommand()));

                $event->execute();
            }
        }
    }
}