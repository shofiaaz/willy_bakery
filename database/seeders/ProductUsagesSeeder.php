<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductUsagesSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $products = DB::table('products')->pluck('product_id')->toArray();
        $materials = DB::table('raw_materials')->pluck('material_id')->toArray();

        $usages = [];
        for ($i = 0; $i < 10; $i++) {
            $usages[] = [
                'product_id' => $products[array_rand($products)],
                'material_id' => $materials[array_rand($materials)],
                'quantity_used' => rand(1,50),
                'created_at' => $now->copy()->subDays(rand(0,13)),
                'updated_at' => $now->copy()->subDays(rand(0,13)),
            ];
        }

        DB::table('product_usages')->insert($usages);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
