<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Diem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem',function(Blueprint $table){
            $table->id();
            $table->integer('hocsinh_id');
            $table->integer('monhoc_id');
            $table->double('HKI');
            $table->double('HKII');
            $table->double('ThiLai')->nullable();
            $table->double('CaNam')->nullable();
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
        Schema::dropIfExists('diem');
    }
}
