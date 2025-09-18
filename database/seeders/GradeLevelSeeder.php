<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GradeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jhs = ['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10'];
        $shs = ['Grade 11', 'Grade 12'];

        foreach($jhs as $grade){
            GradeLevel::Create(['name' => $grade, 'type' => 'JHS']);
        }
        foreach($shs as $grade){
            GradeLevel::Create(['name' => $grade, 'type' => 'SHS']);
        }
    }
}
