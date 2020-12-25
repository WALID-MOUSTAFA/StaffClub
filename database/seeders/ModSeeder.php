<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table("mods")->insert([
                    "fullname"=> "mod1",
                    "nat_id" => "12345678912345",
                    "password"=>"walid"
            ]);
    }
}
