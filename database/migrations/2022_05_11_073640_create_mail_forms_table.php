<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mail_title')->nullable();
            $table->string('header_image')->nullable();
            $table->string('body_image')->nullable();
            $table->longText('body_text_one')->nullable();
            $table->string('button')->nullable();
            $table->string('button_link')->nullable();
            $table->longText('body_text_two')->nullable();
            $table->string('button_one')->nullable();
            $table->string('button_one_link')->nullable();
            $table->string('button_two')->nullable();
            $table->string('button_two_link')->nullable();
            $table->string('button_three')->nullable();
            $table->string('button_three_link')->nullable();
            $table->string('footer_image')->nullable();
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
        Schema::dropIfExists('mail_forms');
    }
}
