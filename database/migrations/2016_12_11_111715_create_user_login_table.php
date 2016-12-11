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
        Schema::create('user_login', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');  
            $table->string('email',30)->unique();
            $table->string('password');
            $table->enum('status',['Active','Pending','Deleted','Banned'])->default('Pending');
            $table->rememberToken();
            $table->integer('creatd_by');
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
        Schema::drop('user_login');
    }
}