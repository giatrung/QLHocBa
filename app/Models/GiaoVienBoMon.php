<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GiaoVienBoMon extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "gv_bo_mon";
    protected $fillable = [
        'gv_id',
        'monhoc_id',
        'namhoc'
    ];
    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function getMonHoc()
    {
        return $this->belongsTo("App\Models\MonHoc", "monhoc_id", "id")->setEagerLoads([]);
    }
    public function getGV()
    {
        return $this->belongsTo("App\Models\User", "gv_id", "id")->setEagerLoads([]);
    }
}
