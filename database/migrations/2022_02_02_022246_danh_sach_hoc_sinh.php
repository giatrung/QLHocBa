<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DanhSachHocSinh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('danhsachhocsinh', function (Blueprint $table) {
            $table->id();
            $table->integer('STT');
            $table->string('Ho');
            $table->string('Ten');
            $table->string('NgaySinh');
            $table->string('DiaChi')->nullable();
            $table->string('TenLop');
            $table->string('NamHoc');
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
        Schema::dropIfExists('danhsachhocsinh');
    }
}
