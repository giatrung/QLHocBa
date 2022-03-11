<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DamNhiem extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "damnhiem";
    protected $fillable = [
        'gv_id',
        'lop_id',
        'namhoc'
    ];
    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function getGV()
    {
        return $this->belongsTo("App\Models\User", "gv_id", "id")->setEagerLoads([]);
    }
    
    public function getLop()
    {
        return $this->belongsTo("App\Models\Lop", "lop_id", "id")->setEagerLoads([]);
    }
}
