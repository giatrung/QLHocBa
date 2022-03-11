<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DanhSachHocSinh extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="danhsachhocsinh";
    protected $fillable = [
        'STT',
        'Ho',
        'Ten',
        'NgaySinh',
        'DiaChi',
        'TenLop',
        'NamHoc',
    ];
    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public static function getDSHocSinh($request,$lop=null,$namhoc=null){
        return self::where('namhoc', $request?$request->input('namhoc'):$namhoc)
        ->where('TenLop', $request?$request->input('lop'):$lop)->where('deleted_at',null)->orderBy('Ten','asc')->get();
    }
}
