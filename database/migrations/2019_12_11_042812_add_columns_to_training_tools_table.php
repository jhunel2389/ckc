<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToTrainingToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('training_tools')->truncate();
        DB::table('users_training_tools')->truncate();
        Schema::table('training_tools', function (Blueprint $table) {
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->integer('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('training_tools', function (Blueprint $table) {
            //
        });
    }
}
