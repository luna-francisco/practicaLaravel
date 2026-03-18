<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Fran',
            'email' => 'lunasancho.fl@gmail.com',
            'password' => bcrypt('Vx8P9ysd')
        ]);

        $this->call([
            StudentsSeeder::class,
        ]);

        $this->call([
            ProjectSeeder::class,
        ]);
    }
}
