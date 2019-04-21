<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {


            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')
                ->nullable()
                ->comment('Nullable, User id of user who created the action');

            /**
             * Type Reference:
             *      admin           - By user role admin
             *      business_owner  - By user role business_owner
             *      employee        - By user role employee
             *      customer        - registered users
             *      public          - unregistered users
             *      system          - logs generated by the system
             *      generic         - generic logs
             */
            $table->enum('type',
                [
                    'admin', 'business_owner', 'employee',
                    'customer', 'public', 'system', 'generic'
                ])
                ->default('generic')
                ->index()
                ->comment('By user roles - admin, business_owner, employee, public, customer. system - created by the system, generic - any');


            $table->ipAddress('ip')
                ->nullable()
                ->index()
                ->default(null)
                ->index()
                ->comment('IP Address of User who created the action');


            $table->string('message')
                ->comment('Required log message')
                ->index();


            $table->json('log_params')
                ->nullable()
                ->default(null)
                ->comment('Other log meta data');


            $table->timestamps();
            $table->softDeletes(); // deleted_at

            /**
             *
             * Foreign Keys
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
        Schema::dropIfExists('logs');
    }
}
