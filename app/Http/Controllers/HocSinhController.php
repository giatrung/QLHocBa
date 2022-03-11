<?php

namespace App\Http\Controllers;

use App\Models\ChuNhiem;
use App\Models\DamNhiem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HocSinhController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    
    public static function index()
    {
        try {
            $lop = \App\Models\Lop::orderBy('TenLop')->get();
            $NamHoc = \App\Models\NamHoc::orderBy('tennamhoc', 'desc')->get();
            $damnhiem = self::getChuNhiemAndDamNhiem()[1]->where('deleted_at',null)->get();
            $chunhiem = self::getChuNhiemAndDamNhiem()[0]->where('deleted_at',null)->first();
            if(Auth::user()->role==1)
            {
                return view('filters', ['damnhiem'=>\App\Http\Resources\DamNhiemResource::collection($damnhiem)->response()->getData(true),'lops' => $lop, 'namhocs' => $NamHoc]);
            }
            return view('welcomeGV',[
                'damnhiems'=>\App\Http\Resources\DamNhiemResource::collection($damnhiem)->response()->getData(true),
                'chunhiem'=>\App\Http\Resources\ChuNhiemResource::make($chunhiem)->response()->getData(true)]);
        } catch (\Exception $err) {
            throw $err;
        }
    }
    public static function filters(Request $request)
    {
        try {
            
            $lopBefore=$request->input('lop');
           
            $namhocBefore=$request->input('namhoc');
            $dshocsinh = \App\Models\DanhSachHocSinh::getDSHocSinh($request);
            $lop = \App\Models\Lop::orderBy('TenLop', 'desc')->get();
            $NamHoc = \App\Models\NamHoc::orderBy('tennamhoc', 'desc')->get();
            $damnhiem= DamNhiem::where('gv_id',request()->user()->id)->get();
            $chunhiem = self::getChuNhiemAndDamNhiem()[0]->where('deleted_at',null)->first();
            return view('dshocsinh', 
            [
            'damnhiems'=>\App\Http\Resources\DamNhiemResource::collection($damnhiem)->response()->getData(true),
            'namhocBefore'=>$namhocBefore,
            'lopBefore'=>$lopBefore,
            'dshocsinh' => $dshocsinh, 
            'lops' => $lop, 'namhocs' => $NamHoc,
            'lop_id'=>$request->input('lop'),
            'chunhiem'=>$chunhiem? \App\Http\Resources\ChuNhiemResource::make($chunhiem)->response()->getData(true): null,
            
        ]);
        } catch (\Exception $err) {
            throw $err;
        }
    }
    public static function showImport()
    {
        return view('nhapdanhsach');
    }
    public static function xoa($id)
    {
        try {
            \App\Models\DanhSachHocSinh::where('id', $id)->delete();
            return back()->withInput([]);
        } catch (\Exception $err) {
            throw $err;
        }
    }
    public static function show($id)
    {
        try {
            $diem = \App\Models\Diem::where('hocsinh_id', $id)->get();
            $monHoc = \App\Models\MonHoc::select("id", "tenmonhoc")->get();
            $damnhiem=\App\Models\DamNhiem::whereHas('getLop',function($query){
                return $query->where('TenLop',request('lop'));
            })->get();
            $lopdamnhiem = self::getChuNhiemAndDamNhiem()[1]->where('deleted_at',null)->get();
            $chunhiem = self::getChuNhiemAndDamNhiem()[0]->where('deleted_at',null)->first();
            $gv_bomon = \App\Models\GiaoVienBoMon::where('deleted_at',null)->get();
            return view('diemhocsinh', 
            [
                'id' => $id,
                'damnhiem'=>\App\Http\Resources\DamNhiemResource::collection($damnhiem)->response()->getData(true),
                'monHocs' => $monHoc,
                'diem' => \App\Http\Resources\DiemResource::collection($diem)->response()->getData(true),
                'lop'=>request('lop'),
                'namhoc'=>request('namhoc'),
                'chunhiem'=>$chunhiem ? \App\Http\Resources\ChuNhiemResource::make($chunhiem)->response()->getData(true):null,
                'damnhiems'=>\App\Http\Resources\DamNhiemResource::collection($lopdamnhiem)->response()->getData(true),
                'gv_bomon'=>$gv_bomon
            ]);

        } catch (\Exception $err) {
            dd($err);
        }
    }
    public function getChuNhiemAndDamNhiem(){
        $chunhiem = ChuNhiem::where('gv_id',request()->user()->id);
        $damnhiem = DamNhiem::where('gv_id',request()->user()->id);
        return [$chunhiem,$damnhiem];
    }
}
