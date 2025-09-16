<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create profile

        Faculty::create([
            'name' => 'Faculty',
            'email' => 'faculty@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
