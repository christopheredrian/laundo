<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->decimal('amount', 8, 2);
            $table->text('details')
                ->nullable();
            $table->unsignedBigInteger('user_id')
                ->unsigned();
            $table->unsignedBigInteger('sale_id')
                ->unsigned();
            $table->timestamps();

            // Reference for foreign keys
            // Always remember to put '->unsigned()' to the column being referenced!
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('sale_id')
                ->references('id')
                ->on('sales');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
