<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $customers = DB::table('customers')->pluck('customer_id')->toArray();
        $products = DB::table('products')->select('product_id','price')->get()->toArray();

        $sales = [];
        for ($i = 0; $i < 20; $i++) {
            $daysAgo = ($i < 10) ? rand(7,13) : rand(0,6); // last week vs this week
            $date = $now->copy()->subDays($daysAgo);
            $product = $products[array_rand($products)];
            $qty = rand(1,6);
            $sales[] = [
                'customer_id' => $customers[array_rand($customers)],
                'product_id' => $product->product_id,
                'quantity' => $qty,
                'price' => $product->price,
                'total' => $product->price * $qty,
                'sale_date' => $date->toDateString(),
                'created_at' => $date,
                'updated_at' => $date,
            ];
        }

        foreach (array_chunk($sales, 500) as $chunk) {
            DB::table('sales')->insert($chunk);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
