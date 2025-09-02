<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'CID' => 1,
            'name' => 'Main Branch',
        ]);
        Branch::create([
            'CID' => 2,
            'name' => 'Secondary Branch',
        ]);
    }
}
