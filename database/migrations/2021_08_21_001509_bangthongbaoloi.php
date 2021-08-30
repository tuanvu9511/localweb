<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Bangthongbaoloi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangthongbaoloi', function (Blueprint $data){
            $data->increments('id');
            $data->integer('id_yeucau');
            $data->string('noidungloi');
            $data->string('cachxuliloi');
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
        Schema::drop('bangthongbaoloi');
    }
}
