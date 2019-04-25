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
                ->nullable()
                ->index();

            $table->string('customer_last_name')
                ->nullable()
                ->index();

            $table->string('phone')
                ->nullable()
                ->index();

            $table->decimal('amount', 8, 2)
                ->unsigned()
                ->index();

            $table->unsignedBigInteger('transaction_id')
                ->unsigned()
                ->index();

            $table->softDeletes();

            $table->timestamps();

            /**
             *
             * Always remember to put '->unsigned()' to the column being referenced!
             *
             */
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
