<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductRecipesSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $products = DB::table('products')->pluck('product_id')->toArray();
        $materials = DB::table('raw_materials')->pluck('material_id')->toArray();

        $recipes = [];

        // For first 10 products, assign 2-4 materials each with realistic quantities
        $i = 0;
        foreach ($products as $pid) {
            if ($i >= 10) break;
            $pick = array_slice($materials, ($i % count($materials)), 4);
            foreach ($pick as $mid) {
                $recipes[] = [
                    'product_id' => $pid,
                    'material_id' => $mid,
                    'quantity_needed' => rand(1,10),
                ];
            }
            $i++;
        }

        foreach ($recipes as $r) DB::table('product_recipes')->insert($r);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
