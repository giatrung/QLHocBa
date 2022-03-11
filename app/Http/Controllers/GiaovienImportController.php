<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Imports\ImportGV;
use Illuminate\Http\Request;

class GiaovienImportController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    public static function show(){
        return view('nhapdanhsach');
    }
    public static function storeGV(Request $request) 
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file=$request->file('file');
        $fileType= strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($fileType!='csv' && $fileType!="xls" && $fileType!="xlsx")
        {
            return back()->withErrors('File không đúng định dạng! File phải có đuôi csv, xls, xlsx');
        }
        $import=new ImportGV;
        $import->import($file);
        return back()->withStatus('Thêm danh sách giáo viên thành công!');
    }
}
