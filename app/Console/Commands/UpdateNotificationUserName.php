<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Notifications\DatabaseNotification;

class UpdateNotificationUserName extends Command
{
    protected $signature = 'notifications:update-username';
    protected $description = 'Update notifications to include the user_name field';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $notifications = DatabaseNotification::all();

        foreach ($notifications as $notification) {
            if (!array_key_exists('user_name', $notification->data)) {
                $rental = Rental::find($notification->data['rental_id']);
                if ($rental) {
                    $data = $notification->data;
                    $data['user_name'] = $rental->user->name;
                    $notification->data = $data;
                    $notification->save();
                }
            }
        }

        $this->info('Notifications updated successfully.');
    }
}
