<?php

namespace App\Http\Controllers;

use App\Models\Lop;
use Illuminate\Http\Request;

class LopController extends Controller
{
    public function create(Request $request)
    {
        try {
            for ($i = 1; $i <= $request->so; $i++) {
                Lop::firstOrCreate([
                    'TenLop' => $request->khoi . $request->khu . $i
                ]);
            }
            return back()->withStatus('Đã tạo lớp từ '.$request->khoi . $request->khu.'1 đến '.$request->khoi.$request->khu.$request->so );
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
