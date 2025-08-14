<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;
use App\Models\User;
use Faker\Factory as Faker;

class LeadSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

    
        if (User::where('role', 'sales')->count() < 3) {
            for ($i = 1; $i <= 3; $i++) {
                User::create([
                    'name' => 'Sales User ' . $i,
                    'email' => 'sales' . $i . '@example.com',
                    'password' => bcrypt('password'),
                    'role' => 'sales',
                ]);
            }
        }

        $salesUsers = User::where('role', 'sales')->pluck('id')->toArray();

        $statuses = ['New', 'Contacted', 'Converted', 'Lost'];
        $sources = ['Website', 'Facebook', 'LinkedIn', 'Referral', 'Google Ads'];

        for ($i = 0; $i < 100; $i++) {
            Lead::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->phoneNumber,
                'status' => $faker->randomElement($statuses),
                'lead_source' => $faker->randomElement($sources),
                'assigned_to' => $faker->randomElement($salesUsers),
                'remarks' => $faker->sentence,
            ]);
        }
    }
}
