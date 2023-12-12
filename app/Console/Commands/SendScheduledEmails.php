<?php

namespace App\Console\Commands;

use App\Models\company;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendScheduledEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:notification-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send scheduled emails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employees = User::select('email', 'name')
            ->where('id_role', '!=', 1)
            ->get();

        foreach ($employees as $employee) {
            Mail::html(view('admin.karyawan.reminder_absent')->render(), function ($message) use ($employee) {
                $message->to($employee->email);
                $message->subject('Hai ' . $employee->name);
            });
        }
    }
}
