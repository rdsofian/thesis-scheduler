<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReadinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('readinesses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("lecturer_id");
            $table->unsignedBigInteger("session_id");
            $table->string("status")->nullable();
            $table->timestamps();

            $table->foreign('lecturer_id')->references('id')->on('lecturers')->onDelete("cascade");
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('readinesses');
    }
}
