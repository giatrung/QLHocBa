<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChuNhiemResource;
use App\Http\Resources\DamNhiemResource;
use App\Http\Resources\GiaoVienBoMonResource;
use App\Models\ChuNhiem;
use App\Models\Lop;
use App\Models\MonHoc;
use App\Models\User;
use App\Models\DamNhiem;
use App\Models\GiaoVienBoMon;
use App\Models\NamHoc;
use Illuminate\Http\Request;

class GiaovienController extends Controller
{
    public static function search(Request $request){
        $gv_list=\App\Models\User::select('')->where('deleted_at',null)->where('name',$request->ten)->get();
        dd($gv_list);
    }
    public function filterGV()
    {
        try {
            $giaovien = User::where('role', 0)->where('deleted_at',null)->get();
            $bomon = MonHoc::get();
            $lop = Lop::get();
            $chunhiem = ChuNhiem::where('deleted_at',null)->get();
            $giaovienbomon = GiaoVienBoMon::get();
            return view('filtersGV', [
                'giaovien' => $giaovien,
                'bomon' => $bomon,
                'lop' => $lop,
                'chunhiem' => ChuNhiemResource::collection($chunhiem)->response()->getData(true),
                'giaovienbomon' => GiaoVienBoMonResource::collection($giaovienbomon)->response()->getData(true)
            ]);
        } catch (\Exception $err) {
            throw $err;
        }
    }
    public function update(Request $request)
    {
        try{
        $namhoc = NamHoc::latest()->first();
        if($request->input('lop')!=0)
        {
            ChuNhiem::updateOrCreate(
                ['gv_id' => $request->input('gv_id'), 'namhoc' => $namhoc->tennamhoc],
                ['lop_id' => $request->input('lop')]
            );
        }
        else{
            ChuNhiem::where('gv_id',$request->input('gv_id'))->where('namhoc','like', $namhoc->tennamhoc)->update(['deleted_at'=>Date('Y-m-d h:m:i'),'lop_id'=> $request->input('lop')]);
        }
        return back()->withStatus('Thay đổi thành công!');
        }catch(\Exception $err){
            throw $err;
            return back()->withStatus($err);
        }
    }
    public function delete(Request $request){
       try{
        User::where('id', $request->id)->update(['deleted_at'=>Date('Y-m-d h:m:i')]);
        return back()->withStatus("Xoá thành công!");
       }catch(\Exception $err)
       {
           throw $err;
       }
    }
    public function phanlop(Request $request){
        try{
            $damnhiem = DamNhiem::where('gv_id',$request->id)->where('deleted_at',null)->get();
            $lop10 = Lop::whereRaw('left(TenLop,2) = 10 ')->get();
            $lop11 = Lop::whereRaw('left(TenLop,2) = 11 ')->get();
            $lop12 = Lop::whereRaw('left(TenLop,2) = 12 ')->get();
            return view('phanlop',
            [
                'gv_id'=>$request->id,
                'lop10'=>$lop10,
                'lop11'=>$lop11,
                'lop12'=>$lop12,
                'damnhiem' => $damnhiem
            ]);
        }catch(\Exception $err){
            throw $err;
        }
    }
    public function storeLop(Request $request){
        try{
          
            if($request->namhoc1 == $request->namhoc2){
                return back()->withErrors('Dữ liệu nhập vào không hợp lệ, vui lòng kiểm tra lại!');
            }
            if($request->lop!=null)
            {
                DamNhiem::where('deleted_at',null)
                ->where('gv_id',$request->id)
                ->where('namhoc',$request->namhoc1.'-'.$request->namhoc2)
                ->whereNotIn('lop_id',$request->lop)->delete();
                
                DamNhiem::withTrashed()->where('gv_id',$request->id)
                    ->where('namhoc',$request->namhoc1.'-'.$request->namhoc2)
                    ->whereIn('lop_id',$request->lop )
                    ->restore();
                foreach($request->lop as $value)
                {
                    DamNhiem::withTrashed()->firstOrCreate(
                        ['gv_id'=>$request->id,'lop_id'=>$value,'namhoc'=>$request->namhoc1.'-'.$request->namhoc2,],[
                        'gv_id'=>$request->id,
                        'namhoc'=>$request->namhoc1.'-'.$request->namhoc2,
                        'lop_id'=>$value,
                    ]);
                }
            }
            else{
                DamNhiem::where('gv_id',$request->id)
                ->where('namhoc',$request->namhoc1.'-'.$request->namhoc2)->delete();
            }
            return back()->withStatus('Thành công! ');
        }catch(\Exception $err){
            throw $err;
        }
    }
}
