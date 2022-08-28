<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTemporariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_temporaries', function (Blueprint $table) {
            $table->id();
            $table->string('day_name');
            $table->date('date');
            $table->time('time');
            $table->string('room');
            $table->string('code');
            $table->string('name');
            $table->string('faculty');
            $table->string('lecturer');
            $table->string('chairman');
            $table->string('vice_chairman');
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
        Schema::dropIfExists('report_temporaries');
    }
}
