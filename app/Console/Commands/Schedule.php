<?php

namespace App\Console\Commands;

use App\Models\Absent;
use App\Models\User;
use Illuminate\Console\Command;

class Schedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:check-attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::select('id')
            ->where('id_role', '!=', 1)
            ->get();

        // Mengubah status pengguna menjadi alpha
        foreach ($users as $user) {
            $absent = new Absent();
            $absent->id_user = $user->id;
            $absent->status = 'alpha';
            $user->absents()->save($absent);
        }
    }
}
