<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SuppliersSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $suppliers = [
            ['supplier_name'=>'Bogasari','email'=>'bogasari@gmail.com','phone'=>'08123458678','address'=>'Jl. Tepung No.1','created_at'=>$now,'updated_at'=>$now],
            ['supplier_name'=>'BakerSupply Co','email'=>'contact@bakersupply.co','phone'=>'081100000001','address'=>'Jl. Roti No.1','created_at'=>$now,'updated_at'=>$now],
            ['supplier_name'=>'FlourMart','email'=>'sales@flourmart.com','phone'=>'081100000002','address'=>'Jl. Tepung 2','created_at'=>$now,'updated_at'=>$now],
            ['supplier_name'=>'YeastWorld','email'=>'hello@yeastworld.id','phone'=>'081100000003','address'=>'Jl. Ragi 3','created_at'=>$now,'updated_at'=>$now],
            ['supplier_name'=>'DairyFresh','email'=>'info@dairyfresh.id','phone'=>'081100000005','address'=>'Jl. Susu 5','created_at'=>$now,'updated_at'=>$now],
        ];

        foreach ($suppliers as $s) DB::table('suppliers')->insert($s);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
