<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassFunds;

class ClassFundsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 records using the factory
        ClassFunds::factory()->count(10)->create();
    }
}