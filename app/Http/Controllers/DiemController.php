<?php

namespace App\Http\Controllers;

use App\Models\ChuNhiem;
use App\Models\DamNhiem;
use App\Models\Diem;
use Illuminate\Http\Request;

class DiemController extends Controller
{

    public static function chamdiem(Request $request)
    {
        try {
            $damnhiem=\App\Models\DamNhiem::where('deleted_at',null)->get();
            $monHoc = \App\Models\MonHoc::select("id", "tenmonhoc")->get();
            $lopdamnhiem = self::getChuNhiemAndDamNhiem()[1]->where('deleted_at',null)->get();
            $chunhiem = self::getChuNhiemAndDamNhiem()[0]->where('deleted_at',null)->first();
            $gvBoMon = \App\Models\GiaoVienBoMon::where('gv_id',request()->user()->id)->first();
            $listGVBoMon = \App\Models\GiaoVienBoMon::get();
            return view('chamdiem',
            [
                'id' =>$request->hocsinh,
                'monHocs' => $monHoc,
                'lop'=>request('lop'),
                'namhoc'=>request('namhoc'),
                'chunhiem'=>\App\Http\Resources\ChuNhiemResource::make($chunhiem)->response()->getData(true),
                'damnhiems'=>\App\Http\Resources\DamNhiemResource::collection($lopdamnhiem)->response()->getData(true),
                'gv_bomon'=>\App\Http\Resources\GiaoVienBoMonResource::make($gvBoMon)->response()->getData(true),
                'damnhiem'=>\App\Http\Resources\DamNhiemResource::collection($damnhiem)->response()->getData(true),
                'listGVBoMon'=>\App\Http\Resources\GiaoVienBoMonResource::collection($listGVBoMon)->response()->getData(true),
            ]);
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public static function chamdiemact(Request $request)
    {
        try {
            Diem::updateOrCreate(
            ['hocsinh_id'=>$request->hocsinh_id,'monhoc_id'=>$request->monhoc_id],
            ['HKI'=>$request->HKI, 'HKII'=>$request->HKII,'CaNam'=>$request->CaNam,'ThiLai'=>$request->ThiLai]
        );
            return back();
        } catch (\Exception $err) {
            throw $err;
        }
    }

    public function getChuNhiemAndDamNhiem(){
        $chunhiem = ChuNhiem::where('gv_id',request()->user()->id);
        $damnhiem = DamNhiem::where('gv_id',request()->user()->id);
        return [$chunhiem,$damnhiem];
    }
}
