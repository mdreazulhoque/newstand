<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailVarificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_varifications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('varification_link');
            $table->timestamp('expiredate');
            $table->enum('status',['Incompleted','Completed'])->default('Incompleted');
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
        Schema::drop('email_varifications');
    }
}
