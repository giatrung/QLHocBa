<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MonHocSeeder extends Seeder
{
    use \App\Traits\GetDummyData;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipments = $this->dummydata('database/data/monhoc.json');
        foreach ($equipments as $value) {
            \App\Models\MonHoc::create((array)$value);
        }
    }
}
