<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expenses;

class ExpensesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 records using the factory
        Expenses::factory()->count(10)->create();
    }
}