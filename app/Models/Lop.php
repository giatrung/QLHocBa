<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    use HasFactory;
    protected $table="lop";
    protected $fillable = [
        'TenLop'
    ];
    public function getTenLop($id){
        return self::where('id',$id)->select('TenLop')->first();
    }
}
