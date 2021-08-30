<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Danhsachthietbisua extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhsachthietbisua',function(Blueprint $data){
            $data->increments('id');
            $data->integer('mathietbisua');
            $data->integer('id_donvisua');
            $data->integer('loaimay');
            $data->integer('hang');
            $data->integer('cauhinh');
            $data->integer('chusohuu');
            $data->string('chuandoanloi');
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
