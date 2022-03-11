<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DamNhiem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('damnhiem',function(Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('gv_id');
            $table->string('lop_id')->nullable();
            $table->string('namhoc')->default(null);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('damnhiem');
    }
}
