<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LichSuThayDoiDiem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lich_su_thay_doi_diem',function(Blueprint $table){
            $table->id();
            $table->string('gv_id');
            $table->string('monhoc_id');
            $table->double('HKI')->nullable();
            $table->double('HKII')->nullable();
            $table->double('ThiLai')->nullable();
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
        Schema::dropIfExists('chunhiem');
    }
}
