<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname');
            $table->string('lname');
            $table->string('email');
            $table->string('password');
            $table->string('photo')->default('doctor.png');
            $table->integer('menulist_id');
            $table->integer('menulist2_id')->nullable(true);
            $table->integer('experience');
            $table->integer('specialist1_id');
            $table->integer('degree_id');
            $table->integer('specialist2_id')->nullable(true);
            $table->string('authorization_no');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->integer('area_id');
            $table->string('phone');
            $table->string('office_address');
            $table->string('video_photo')->default('video.png');
            $table->string('video_link');
            $table->string('facebook_link')->nullable(true);
            $table->string('twitter_link')->nullable(true);
            $table->string('instagram_link')->nullable(true);
            $table->string('youtube_link')->nullable(true);
            $table->string('doctor_cv');
            $table->time('work_start_time')->default('09:00:00');
            $table->time('work_end_time')->default('20:00:00');
            $table->string('work_start_day')->default('Monday');
            $table->string('working_end_day')->default('Friday');
            $table->string('pcode')->nullable(true);
            $table->integer('service_chat')->default(1);
            $table->integer('service_call')->default(1);
            $table->integer('service_video')->default(1);
            $table->integer('remain_chat')->default(0);
            $table->integer('remain_call')->default(0);
            $table->integer('remain_video')->default(0);
            $table->integer('money')->default(0);
            $table->integer('reader')->default(0);
            $table->float('rate', 8, 2)->default(0);
            $table->integer('satisfied')->default(0);
            $table->integer('answer_no')->default(0);
            $table->integer('online')->default(1);
            $table->integer('approve')->default(0);
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
        Schema::dropIfExists('doctors');
    }
}
