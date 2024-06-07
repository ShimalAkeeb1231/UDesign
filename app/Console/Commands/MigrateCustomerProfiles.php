<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\CustomerProfile;

class MigrateCustomerProfiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:customer-profiles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate user data to customer_profiles table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::where('role', 3)->get();

        foreach ($users as $user) {
            CustomerProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'full_name' => $user->name,
                    'address' => $user->address, // assuming you have address column in users table
                    'phone_number' => $user->phone_number, // assuming you have phone_number column in users table
                    'email' => $user->email,
                ]
            );
        }

        $this->info('Customer profiles migrated successfully.');
    }
}
