<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('companyـofficial_name')->nullable();
            $table->string('commercial_registration_no')->nullable();
            $table->string('companyـcontract')->nullable();
            $table->text('address')->nullable();
            $table->boolean('status')->default(1);
            $table->date('start_decade')->nullable();
            $table->date('end_decade')->nullable();
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
        Schema::dropIfExists('companies');
    }
}
