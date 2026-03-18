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

        User::updateOrCreate(
            ['email' => 'lunasancho.fl@gmail.com'],
            [
                'name' => 'Fran',
                'password' => bcrypt('Vx8P9ysd'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'admin@demo.test'],
            [
                'name' => 'Admin Demo',
                'password' => bcrypt('admin1234'),
                'role' => 'admin',
            ]
        );

        User::factory()->create();

        $this->call([
            StudentsSeeder::class,
            TeacherSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}
