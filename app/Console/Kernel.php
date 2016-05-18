<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [ // Commands\Inspire::class,
        Commands\CheckServeIp::class,Commands\FlowLog::class,Commands\FlowClear::class,Commands\Reboot::class, ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule( Schedule $schedule )
    {

        // $schedule->command('inspire')
        //          ->hourly();

        //检查ip
        $schedule->command( 'checkip' )->hourly()->withoutOverlapping();
        //$schedule->exec ( 'system:reboot' )->dailyAt ( '6:00' );
        //记录日志
        $schedule->command( 'flow:log' )->daily()->withoutOverlapping();
        $schedule->command( 'flow:clear' )->daily()->withoutOverlapping();

        // $schedule->command('inspire')->hourly();

        /**
         * Laravel Backup Commands
         */
        // $schedule->command('backup:clean')->daily()->at('01:00');
        // $schedule->command('backup:run')->daily()->at('02:00');

    }
}
