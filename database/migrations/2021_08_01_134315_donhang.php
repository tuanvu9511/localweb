<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Donhang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang',function(Blueprint $data){
            $data->increments('id_donhang');
            $data->integer('id_yeucau');
            $data->text('thietbibangiao');
            $data->integer('tinhtrang');
            $data->text('ghichu');
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
        //
    }
}
