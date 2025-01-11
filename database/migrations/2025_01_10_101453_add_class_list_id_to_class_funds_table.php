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
        Schema::table('class_funds', function (Blueprint $table) {
            $table->foreignId('class_list_id')->constrained('class_lists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('class_funds', function (Blueprint $table) {
            $table->dropForeign(['class_list_id']);
            $table->dropColumn('class_list_id');
        });
    }
};
