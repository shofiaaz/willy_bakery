<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        $customers = [];
        for ($i = 1; $i <= 10; $i++) {
            $customers[] = [
                'customer_name' => "Customer {$i}",
                'email' => "customer{$i}@example.com",
                'phone' => '0812' . str_pad(rand(1000000,9999999),7,'0',STR_PAD_LEFT),
                'address' => "Jl. Pelanggan No. {$i}",
                'created_at' => $now->copy()->subDays(rand(0,30)),
                'updated_at' => $now->copy()->subDays(rand(0,5)),
            ];
        }

        DB::table('customers')->insert($customers);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
