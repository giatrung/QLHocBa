<?php

namespace App\Http\Controllers;
use App\Imports\Import;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Exception;

class HocSinhImPortController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    public static function show(){
        return view('danhsachhocsinh');
    }
    public static function store(Request $request) 
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file=$request->file('file');
        $fileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($fileType!='csv' && $fileType!="xls" && $fileType!="xlsx")
        {
            return back()->withErrors('File không đúng định dạng! File phải có đuôi csv, xls, xlsx');
        }
        $import=new Import;
        $import->import($file);
        // Excel::import(new Import, $file);
        return back()->withStatus('Thêm danh sách học sinh thành công!');
    }
}
