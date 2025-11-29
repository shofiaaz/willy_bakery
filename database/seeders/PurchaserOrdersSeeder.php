<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PurchaserOrdersSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $supplier = DB::table('suppliers')->first();
        $user = DB::table('users')->first();
        $products = DB::table('products')->pluck('product_id','product_name')->toArray();

        if ($supplier && $user) {
            $orderId = DB::table('purchaser_orders')->insertGetId([
                'supplier_id' => $supplier->supplier_id,
                'user_id' => $user->user_id,
                'order_date' => $now->toDateString(),
                'status' => 'Completed',
                'total_price' => 1700000.00,
                'created_at' => $now->copy()->subDays(4),
                'updated_at' => $now->copy()->subDays(3),
            ]);

            // Add items (example: large quantity of first product)
            $firstProduct = DB::table('products')->first();
            if ($firstProduct) {
                DB::table('purchaser_order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $firstProduct->product_id,
                    'quantity' => 100,
                    'price' => $firstProduct->price,
                    'subtotal' => $firstProduct->price * 100,
                ]);
            }
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
