<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DailyProductionsSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $products = DB::table('products')->pluck('product_id')->toArray();

        $productions = [];
        for ($i = 0; $i < 20; $i++) {
            $daysAgo = ($i < 10) ? rand(7,13) : rand(0,6);
            $date = $now->copy()->subDays($daysAgo);
            $productions[] = [
                'product_id' => $products[array_rand($products)],
                'production_date' => $date->toDateString(),
                'quantity_produced' => rand(5,120),
                'status' => 'completed',
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        foreach (array_chunk($productions, 500) as $chunk) {
            DB::table('daily_productions')->insert($chunk);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
