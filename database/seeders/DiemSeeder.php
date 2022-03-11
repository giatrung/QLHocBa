<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Null_;

class DiemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 12; $i++) {
            \App\Models\Diem::create([
                'hocsinh_id' => rand(1, 7),
                'monhoc_id' => rand(1, 12),
                'HKI' => rand(0, 10),
                'HKII' => rand(0, 10),
                'ThiLai' => Null,
                'CaNam' => Null
            ]);
        }
    }
}
