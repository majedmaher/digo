<?php

use App\Models\Tax;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Tax::class)->constrained()->onDelete('cascade');
            $table->string('description')->nullable();
            $table->integer('quantity');
            $table->float('price');
            $table->float('total_price');
            $table->integer('tax_rate')->default(15);
            $table->float('tax_amount');
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
        Schema::dropIfExists('tax_items');
    }
}
