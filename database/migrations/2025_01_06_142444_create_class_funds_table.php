<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('class_funds', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID column
            $table->string('name'); // Fund name
            $table->text('description')->nullable(); // Fund description
            $table->decimal('amount', 8, 2); // Monetary value
            $table->date('date'); // Date of allocation
            $table->decimal('contributions', 8, 2)->default(0); // Total expenses
            $table->decimal('expenses', 8, 2)->default(0); // Total expenses
            $table->string('category')->nullable(); // Fund category
            $table->string('status')->default('active'); // Fund status
            $table->decimal('balance', 8, 2)->default(0); // Current balance
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_funds');
    }
};
