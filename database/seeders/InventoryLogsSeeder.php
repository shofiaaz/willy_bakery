<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoryLogsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $materials = DB::table('raw_materials')->pluck('material_id')->toArray();
        $products = DB::table('products')->pluck('product_id')->toArray();

        $logs = [];
        for ($i = 0; $i < 15; $i++) {
            $logs[] = [
                'product_id' => (rand(0,1) ? $products[array_rand($products)] : null),
                'material_id' => (rand(0,1) ? $materials[array_rand($materials)] : null),
                'type' => ['consumption','initial_stock','product_created','OUT'][array_rand(['consumption','initial_stock','product_created','OUT'])],
                'quantity' => (int) (rand(1,50) * (rand(0,1) ? 1 : -1)),
                'timestamp' => $now->copy()->subDays(rand(0,13)),
            ];
        }

        DB::table('inventory_logs')->insert($logs);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
