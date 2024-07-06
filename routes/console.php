<?php

use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();


$env = config('app.env');
$email = config('mail.username');

if ($env === 'live') {
    //Scheduling backup, specify the time when the backup will get cleaned & time when it will run.
    Schedule::command('backup:run')->dailyAt('23:50');

    //Schedule to create recurring invoices
    Schedule::command('pos:generateSubscriptionInvoices')->dailyAt('23:30');
    Schedule::command('pos:updateRewardPoints')->dailyAt('23:45');

    Schedule::command('pos:autoSendPaymentReminder')->dailyAt('8:00');
}

if ($env === 'demo') {
    //IMPORTANT NOTE: This command will delete all business details and create dummy business, run only in demo server.
    Schedule::command('pos:dummyBusiness')
        ->cron('0 */3 * * *')
            //->everyThirtyMinutes()
        ->emailOutputTo($email);
}

// Let's clear "cache", "config", "view", ... every day with CRON Job:
// Schedule::command('optimize:clear')->daily();
// Schedule::command('optimize:clear')->weekly();
Schedule::command('route:cache')->daily();
