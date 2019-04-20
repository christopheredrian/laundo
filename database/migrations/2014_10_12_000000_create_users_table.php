<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->bigIncrements('id');

            $table->string('first_name')
                ->index();

            $table->string('last_name')
                ->index();

            $table->unsignedBigInteger('role_id')
                ->unsigned();

            $table->string('email')
                ->unique()
                ->index();

            $table->timestamp('email_verified_at')
                ->nullable();

            $table->string('password');

            $table->rememberToken();

            $table->timestamps();

            /**
             *
             * Always remember to put '->unsigned()' to the column being referenced!
             * Reference for foreign keys
             *
             */
            $table->foreign('role_id')
                ->references('id')
                ->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
