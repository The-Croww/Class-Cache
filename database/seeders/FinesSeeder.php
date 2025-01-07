<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fines;

class FinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 records using the factory
        Fines::factory()->count(10)->create();
    }
}