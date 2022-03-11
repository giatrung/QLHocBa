<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "abc",
            "email"=> "duonggiatrung113@gmail.com",
            "password"=> bcrypt("trung113!"),
            "role"=>1
        ]);
    }
}
