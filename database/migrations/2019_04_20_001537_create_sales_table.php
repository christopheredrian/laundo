<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer_first_name')
                ->index();
            $table->string('customer_last_name')
                ->index();
            $table->string('phone');
            $table->unsignedBigInteger('transaction_id')
                ->unsigned();
            $table->timestamps();

            // Reference for foreign keys
            // Always remember to put '->unsigned()' to the column being referenced!
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
