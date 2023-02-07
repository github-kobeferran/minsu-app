<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('home_address')->nullable()->change();
            $table->string('work_address')->nullable()->change();
            $table->integer('age')->nullable()->change();
            $table->string('id_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('home_address')->change();
            $table->string('work_address')->change();
            $table->integer('age')->change();
            $table->string('id_number')->change();
        });
    }
};
