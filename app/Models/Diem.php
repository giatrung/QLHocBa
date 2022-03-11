<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diem extends Model
{
    use HasFactory;
    protected $table="diem";
    protected $fillable = [
        'hocsinh_id',
        'monhoc_id',
        'HKI',
        'HKII',
        'ThiLai',
        'CaNam',
    ];
    public function diemHocSinh(){
        return $this->belongsTo('App\Models\DanhSachHocSinh', 'hocsinh_id', 'id')->setEagerLoads([]); // khi controller trả ra kết quả cho view thì phải trả theo kiểu $data->response()->getData(true)
    }
    public function tenMonHoc(){
        return $this->belongsTo('App\Models\MonHoc', 'monhoc_id', 'id')->setEagerLoads([]);
    }
}
