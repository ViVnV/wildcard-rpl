<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->createMany([
            ['name' => 'Arikusuma Wardana', 'email' => 'arikusuma@arijaya.com'],
            ['name' => 'Nauval Khilmi', 'email' => 'nauvalkhilmi@arijaya.com'],
            ['name' => 'Adi Aryasuta', 'email' => 'adiaryasuta@arijaya.com'],
            ['name' => 'Vincent Dua Orang', 'email' => 'vincentptk@arijaya.com'],
            ['name' => 'Momet Dwika', 'email' => 'mometdwika@arijaya.com'],
        ]);
    }
}