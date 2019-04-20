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

            $table->decimal('amount', 8, 2)
                ->index();

            /**
             * Reference
             * https://www.accountingtools.com/articles/2017/5/17/debits-and-credits
             * debit    - increase
             * credit   - decrease
             */
            $table->enum('type', ['debit', 'credit'])
                ->index()
                ->comment('Indicates the type of transaction either debit (increase)/ credit (decrease)');

            /**
             * Generic message for this transaction
             */
            $table->text('comment')
                ->nullable();

            $table->json('metadata')
                ->nullable()
                ->comment('Any metadata for this transaction');

            $table->unsignedBigInteger('user_id')
                ->unsigned()
                ->index()
                ->comment('User who created the transaction');

            $table->timestamps();

            /**
             *
             * Reference for foreign keys
             * Always remember to put '->unsigned()' to the column being referenced!
             *
             */
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
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
