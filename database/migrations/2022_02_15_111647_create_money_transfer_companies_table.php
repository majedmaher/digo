<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoneyTransferCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('money_transfer_companies', function (Blueprint $table) {
            $table->id();
            $table->integer('company_id');
            $table->float('amount');
            $table->date('date');
            $table->date('month_due')->nullable();
            $table->string('passbook')->nullable();
            $table->string('financial_claim')->nullable();
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
        Schema::dropIfExists('money_transfer_companies');
    }
}
