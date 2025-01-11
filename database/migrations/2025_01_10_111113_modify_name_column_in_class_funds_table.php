<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyNameColumnInClassFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_funds', function (Blueprint $table) {
            // Modify the 'name' column to be nullable
            $table->string('name')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_funds', function (Blueprint $table) {
            // Revert the 'name' column to be non-nullable if necessary
            $table->string('name')->nullable(false)->change();
        });
    }
}
