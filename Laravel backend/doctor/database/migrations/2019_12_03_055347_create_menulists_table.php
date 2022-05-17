<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenulistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menulists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->integer('price_chat')->default(10);;
            $table->integer('price_voice')->default(20);;
            $table->integer('prive_video')->default(30);;
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
        Schema::dropIfExists('menulists');
    }
}
