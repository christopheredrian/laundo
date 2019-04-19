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
            $table->string('customer_name');
            $table->string('customer_contact_number');
            $table->decimal('amount', 8, 2);
            $table->dateTimeTz('date_of_transaction');
            $table->unsignedBigInteger('responsible_employee_for_transaction')->unsigned();
            $table->text('details')->nullable();
            $table->timestamps();

            // Reference for foreign keys
            // Always remember to put '->unsigned()' to the column being referenced!
            $table->foreign('responsible_employee_for_transaction')->references('id')->on('users');
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
