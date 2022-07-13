<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresenceAbsencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presence_absences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('officer_id');
            $table->string('day', 10);
            $table->date('date');
            $table->char('audience', 5)->nullable();
            $table->char('leave', 5)->nullable();
            $table->char('break', 5)->nullable();
            $table->char('working_hours', 5)->nullable();
            $table->char('incapacity_hours', 5)->nullable();
            $table->longText('clarifications')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('presence_absences');
    }
}
