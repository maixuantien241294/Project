<?php

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
            $table->string('name_vi',255);
            $table->string('name_en',255);
            $table->string('summary_vi',255);
            $table->string('summary_en',255);
            $table->text('description_vi');
            $table->text('description_en');
            $table->tinyInteger('status')->length(1);
            $table->tinyInteger('featured')->length(1);
            $table->tinyInteger('order')->length(4);
            $table->string('images',255);
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
