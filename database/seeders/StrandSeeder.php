<?php

namespace Database\Seeders;

use App\Models\Strand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          $strands = [
            ['code' => 'STEM',  'name' => 'Science, Technology, Engineering, and Mathematics'],
            ['code' => 'ABM',   'name' => 'Accountancy, Business, and Management'],
            ['code' => 'HUMSS', 'name' => 'Humanities and Social Sciences'],
            ['code' => 'GAS',   'name' => 'General Academic Strand'],
            ['code' => 'TVL',   'name' => 'Technical-Vocational-Livelihood'],
        ];

        foreach ($strands as $strand) {
            Strand::firstOrCreate(['code' => $strand['code']], $strand);
        }
    }

}
