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
use Anonym\Components\Cron\Cron as Schedule;

class ScheduleCleanCommands extends Command
{

    /**
     * signature of command
     *
     * @var string
     */
    protected $name = 'schedule:clean';

    /**
     * description of command
     *
     * @var string
     */
    protected $description = 'clean the scheduled commands';

    /**
     * the instance of cron
     *
     * @var Schedule
     */
    protected $schedule;

    /**
     * create a new instance and register schedule instance to $schedule variable
     *
     * @param Schedule $schedule
     */
    public function __construct(Schedule $schedule = null)
    {
        $this->schedule = $schedule;

        parent::__construct();
    }

    /**
     * Komut yakalandığı zaman tetiklenecek fonksiyonlardan biridir
     * @return mixed
     */
    public function fire()
    {
        // clean the all commands
        $this->schedule->clean();

        $this->info('all commands  cleaned');
    }
}