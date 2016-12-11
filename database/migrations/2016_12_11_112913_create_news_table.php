<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('news_title');
            $table->string('news_slug')->unique();
            $table->string('photo_url');
            $table->text('news_content');
            $table->timestamp('expiredate');
            $table->enum('status',['Publish','Unpublished','Pending','Deleted'])->default('Pending');
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
        Schema::drop('news');
    }
}
