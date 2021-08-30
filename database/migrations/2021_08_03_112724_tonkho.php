<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tonkho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonkho',function(Blueprint $data){
            $data->increments('id');
            $data->integer('mathietbi');
            $data->integer('chungloai');
            $data->integer('hang');
            $data->integer('cauhinh');
            $data->integer('soluong');
            $data->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tonkhothietbi');
    }
}
