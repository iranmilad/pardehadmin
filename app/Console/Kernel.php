<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Services\ProductPriceHistoryService;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('queue:work --stop-when-empty')->everySecond();

        $schedule->call(function () {
            app(ProductPriceHistoryService::class)->updateMonthlyPriceHistory();
        })->monthlyOn(1, '00:00');

    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
