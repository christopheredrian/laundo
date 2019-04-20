<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\User;

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

            /**
             * User Role
             */
            $table->enum('role',User::VALID_USER_ROLES);

            $table->string('email')
                ->unique()
                ->index();


            $table->string('first_name')
                ->index();

            $table->string('last_name')
                ->index();

            /**
             * Tokens
             */
            $table->string('verified', '1')
                ->default(User::UNVERIFIED_USER)
                ->index();

            $table->string('verification_token')
                ->nullable()
                ->index();


            $table->timestamp('email_verified_at')
                ->nullable();

            $table->string('password');

            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
