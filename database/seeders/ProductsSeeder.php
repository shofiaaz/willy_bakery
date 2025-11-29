<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $products = [
            ['product_name'=>'Chocolate Filled Bun','description'=>'Soft bun filled with rich chocolate','stock'=>80,'price'=>12000.00],
            ['product_name'=>'Cinnamon Roll','description'=>'Sweet cinnamon roll with glaze','stock'=>60,'price'=>17000.00],
            ['product_name'=>'Cream Cheese Danish','description'=>'Flaky pastry with cream cheese','stock'=>40,'price'=>22000.00],
            ['product_name'=>'Garlic Bread','description'=>'Savory garlic butter bread','stock'=>100,'price'=>10000.00],
            ['product_name'=>'Chocolate Croissant','description'=>'Buttery croissant with chocolate','stock'=>50,'price'=>18000.00],
            ['product_name'=>'Almond Bread','description'=>'Bread topped with sliced almonds','stock'=>30,'price'=>20000.00],
            ['product_name'=>'Raisin Roll','description'=>'Soft roll with raisins','stock'=>70,'price'=>15000.00],
            ['product_name'=>'Sourdough Loaf','description'=>'Classic sourdough bread loaf','stock'=>25,'price'=>25000.00],
            ['product_name'=>'Milk Bun','description'=>'Sweet milk-flavored bun','stock'=>90,'price'=>13000.00],
            ['product_name'=>'Chocolate Chip Muffin','description'=>'Muffin loaded with chocolate chips','stock'=>60,'price'=>14000.00],
        ];

        foreach ($products as $p) {
            $p['created_at'] = $now;
            $p['updated_at'] = $now;
            DB::table('products')->insert($p);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
