<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $data = [];

        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
            ];
        }

        $chunks = array_chunk($data, 1000);

        foreach ($chunks as $chunk) {
            User::insert($chunk);
        }
    }
}
