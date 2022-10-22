<?php

use App\Models\Package;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Package::class)->constrained();

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone_number');

            $table->string('payment_type');
            $table->string('transaction_id')->nullable();
            $table->string('currency');
            $table->float('gross_amount', 8, 2);
            $table->float('paypal_fee', 8, 2);
            $table->float('net_amount', 8, 2);
            $table->string('order_number')->nullable();

            $table->string('invoice_no');
            $table->string('order_date');
            $table->string('client_ip');

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
        Schema::dropIfExists('payments');
    }
}
