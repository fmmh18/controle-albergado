<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where('email', 'fhayashida@afdsoluion.tec.br')->first();

        if (empty($user->id)) {
            User::create([
                'name' => 'Flavio Hayashida',
                'email' => 'fhayashida@afdsolution.tec.br',
                'password' => 'jhmcma130902',
                'status' => 1
            ]);
        }
    }
}
