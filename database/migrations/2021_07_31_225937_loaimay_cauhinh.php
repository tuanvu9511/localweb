<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LoaimayCauhinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    
    public function up()
    {
        Schema::create('loaimay', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tenloaimay');
            $table->timestamps();
        });
        Schema::create('cauhinh', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tencauhinh');
            $table->integer('id_loaimay');
            $table->integer('soluong');
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
        Schema::drop('loaimay');
        Schema::drop('cauhinh');
    }
}
