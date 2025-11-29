<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SupplierProfilesSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $now = Carbon::now();

        // Map supplier_id -> profile data by reading suppliers table
        $suppliers = DB::table('suppliers')->select('supplier_id','supplier_name')->get();

        foreach ($suppliers as $s) {
            DB::table('supplier_profiles')->insert([
                'supplier_id' => $s->supplier_id,
                'contact_person' => $s->supplier_name . ' Contact',
                'company_type' => 'CV',
                'notes' => 'Delivery twice a week',
            ]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
