<?php

namespace Database\Seeders;

use App\Models\Registrar;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegistrarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Registrar::create([
            'name' => 'Registrar',
            'email' => 'registrar@gmail.com',
            'password' => Hash::make('password')
        ]);
    }
}
