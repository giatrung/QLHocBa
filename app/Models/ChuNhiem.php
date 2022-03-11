<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChuNhiem extends Model
{
    use HasFactory,SoftDeletes;
    protected $table="chunhiem";
    protected $fillable=[
        'gv_id',
        'lop_id',
        'namhoc'
    ];
    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function getLop()
    {
        return $this->belongsTo("App\Models\Lop", "lop_id", "id")->setEagerLoads([]);
    }
}
