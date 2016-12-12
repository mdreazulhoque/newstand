<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_users', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('role',['User','Admin'])->default('User');
            $table->integer('user_id');  
            $table->string('email',30)->unique();
            $table->string('password')->nullable();
            $table->enum('status',['Active','Pending','Deleted','Banned'])->default('Pending');
            $table->rememberToken();
            $table->integer('created_by')->nullable()->default(0);
            $table->integer('updated_by')->nullable()->default(0);
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
        Schema::drop('login_users');
    }
}
