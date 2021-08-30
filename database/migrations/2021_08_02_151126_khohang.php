<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Khohang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhsachtongthietbi',function(Blueprint $data){
            $data->integer('id');
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
        //
    }
}
