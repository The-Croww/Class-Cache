<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contributions;

class ContributionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 records using the factory
        Contributions::factory()->count(10)->create();
    }
}