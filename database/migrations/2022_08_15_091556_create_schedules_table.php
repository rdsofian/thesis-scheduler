<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("submission_id")->unique();
            $table->unsignedBigInteger("session_id");
            $table->unsignedBigInteger("chairman_id");
            $table->unsignedBigInteger("vice_chairman_id");
            $table->string("Room");
            $table->timestamps();

            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete("cascade");
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete("cascade");
            $table->foreign('chairman_id')->references('id')->on('lecturers')->onDelete("cascade");
            $table->foreign('vice_chairman_id')->references('id')->on('lecturers')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
