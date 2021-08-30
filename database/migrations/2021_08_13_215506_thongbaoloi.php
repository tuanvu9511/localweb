<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Thongbaoloi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thongbaoloi',function(Blueprint $table){
            $table->increments('id');
            $table->integer('id_yeucau');
            $table->string('noidungbaoloi');
            $table->integer('tinhtrangxuli');
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
        Schema::drop('thongbaoloi');
    }
}
