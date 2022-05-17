<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable(true);
            $table->string('phone');
            $table->string('password');
            $table->string('username');
            $table->string('photo')->default('patient.png');
            $table->integer('money')->default(0);
            $table->integer('sex');
            $table->string('address')->nullable(true);
            $table->string('more_info')->nullable(true);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
