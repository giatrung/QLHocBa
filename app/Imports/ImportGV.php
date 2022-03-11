<?php

namespace App\Imports;

use App\Models\ChuNhiem;
use App\Models\DamNhiem as ModelsDamNhiem;
use App\Xxx;
use App\Models\DanhSachHocSinh;
use App\Models\GiaoVienBoMon;
use App\Models\Lop;
use App\Models\NamHoc;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Models\MonHoc;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ImportGV implements WithMultipleSheets, WithHeadingRow, WithValidation, ToCollection
{
    use Importable;
    /**
     * @param array $row
     *
     * @return Xxx|null
     */
    public function collection(Collection $rows)
    {
        try {
            DB::beginTransaction();
            $namhoc=null;
            if(request('namhoc1')!=null && request('namhoc2')!=null){
                $namhoc=request('namhoc1').'-'.request('namhoc2');
            }
            foreach ($rows as $row) {
                $tenmonhoc = substr($row['bo_mon'], 0, 1 ). substr($row['bo_mon'], 1);
                User::firstOrCreate(
                    ['name' => $row['ho_ten']],
                    [
                        'email' => $row['email'],
                        'password' => bcrypt(explode("@", $row['email'])[0]),
                        'role' => 0
                    ]
                );
                
                MonHoc::firstOrCreate([
                    'tenmonhoc' => $tenmonhoc,
                ]);

                GiaoVienBoMon::firstOrCreate(
                    [
                    'gv_id' => User::latest('id')->where('name', $row['ho_ten'])->select('id')->first()->id,
                    'monhoc_id' => MonHoc::where('tenmonhoc', $tenmonhoc)->select('id')->first()->id,
                    'namhoc' =>$namhoc
                ]);

                if(isset($row['chu_nhiem'])){
                    ChuNhiem::firstOrCreate([
                        'lop_id'=>Lop::where('TenLop','LIKE',$row['chu_nhiem'])->select('id')->first()->id,
                        'gv_id'=>User::latest('id')->where('name', $row['ho_ten'])->select('id')->first()->id,
                        'namhoc' =>$namhoc
                    ]);
                }
            }
            DB::commit();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            dd($ex->getMessage());
        }
    }

    public function sheets(): array
    {
        return [
            new self()
        ];
    }

    public function rules(): array
    {
        return [
            '*.ho_ten' => ['string', 'required'],
            '*.email' => ['email', 'required'],
            '*.bo_mon' => ['string', 'required'],
        ];
    }
}
