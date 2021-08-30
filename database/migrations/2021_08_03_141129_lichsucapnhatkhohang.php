<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Lichsucapnhatkhohang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lichsucapnhatkhohang', function(Blueprint $data){
            $data->increments('id');
            $data->string('lichsucapnhatkhohang','255');
            $data->integer('id_nguoidung');
            $data->integer('id_loai');
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
        Schema::drop('lichsucapnhatkhohang');
    }
}
