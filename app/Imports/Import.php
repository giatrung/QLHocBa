<?php

namespace App\Imports;

use App\Xxx;
use App\Models\DanhSachHocSinh;
use App\Models\Lop;
use App\Models\NamHoc;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
class Import implements WithMultipleSheets, WithHeadingRow, WithValidation, ToCollection, WithMapping
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
            foreach ($rows as $row) {
                DanhSachHocSinh::firstOrCreate([
                    'STT' => $row['stt'],
                    'Ho' => $row['ho'],
                    'Ten' => $row['ten'],
                    'NgaySinh' => $row['ngay_sinh'],
                    'DiaChi' => $row['dia_chi'],
                    'TenLop' => $row['lop'],
                    'NamHoc' => $row['nam_hoc']??request('namhoc1').'-'.request('namhoc2'),
                ]);
                Lop::firstOrCreate([
                    'TenLop' => strtoupper($row['lop'])
                ]);
                NamHoc::firstOrCreate([
                    'tennamhoc' => $row['nam_hoc']
                ]);
            }
            DB::commit();
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            throw $ex->getMessage();
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
            '*.stt' => ['integer', 'required'],
            '*.ho' => ['string', 'required'],
            '*.ten' => ['string', 'required'],
            '*.dia_chi' => ['string'],
            '*.lop' => ['string', 'required'],
            '*.date' => ['date_format:YYYY-MM-DD']
        ];
    }

    //Khi import thì dữ liệu sẽ chạy vào hàm map trước để chuyển đổi kiểu dữ liệu date cho phù hợp rồi mới chuyển vào hàm rules() để validate
    public function map($row): array //
    {

        if (isset($row['ngay_sinh']) && gettype($row['ngay_sinh']) != 'date') {
            $row['ngay_sinh'] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['ngay_sinh']);
        }
        return $row;
    }
}
