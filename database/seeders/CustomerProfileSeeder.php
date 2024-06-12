<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CustomerProfile;

class CustomerProfileSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        foreach ($users as $user) {
            CustomerProfile::create([
                'user_id' => $user->id,
                'full_name' => $user->name,
                'address' => $user->address,
                'phone_number' => $user->phone_number,
                'email' => $user->email,
            ]);
        }
    }
}
