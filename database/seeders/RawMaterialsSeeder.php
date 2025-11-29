<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RawMaterialsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $materials = [
            ['material_name'=>'Tepung Terigu','stock'=>200,'unit'=>'Kg','cost_per_unit'=>12000.00],
            ['material_name'=>'Ragi','stock'=>100,'unit'=>'Kg','cost_per_unit'=>3500.00],
            ['material_name'=>'Gula','stock'=>150,'unit'=>'Kg','cost_per_unit'=>10000.00],
            ['material_name'=>'Susu Bubuk','stock'=>80,'unit'=>'Kg','cost_per_unit'=>20000.00],
            ['material_name'=>'Butter','stock'=>60,'unit'=>'Kg','cost_per_unit'=>60000.00],
            ['material_name'=>'Coklat Filling','stock'=>80,'unit'=>'Kg','cost_per_unit'=>45000.00],
            ['material_name'=>'Telur','stock'=>500,'unit'=>'Pcs','cost_per_unit'=>1500.00],
            ['material_name'=>'Garam','stock'=>50,'unit'=>'Kg','cost_per_unit'=>8000.00],
            ['material_name'=>'Air','stock'=>10000,'unit'=>'L','cost_per_unit'=>0.00],
            ['material_name'=>'Keju','stock'=>40,'unit'=>'Kg','cost_per_unit'=>70000.00],
            ['material_name'=>'Kismis','stock'=>30,'unit'=>'Kg','cost_per_unit'=>50000.00],
            ['material_name'=>'Susu Cair','stock'=>120,'unit'=>'L','cost_per_unit'=>12000.00],
            ['material_name'=>'Minyak','stock'=>60,'unit'=>'L','cost_per_unit'=>15000.00],
            ['material_name'=>'Vanila','stock'=>20,'unit'=>'Kg','cost_per_unit'=>150000.00],
            ['material_name'=>'Cocoa Powder','stock'=>50,'unit'=>'Kg','cost_per_unit'=>65000.00],
        ];

        foreach ($materials as $m) {
            $m['created_at'] = $now;
            $m['updated_at'] = $now;
            DB::table('raw_materials')->insert($m);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
