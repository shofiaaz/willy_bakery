<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // existing
            // UserSeeder::class,

            // master / reference data first
            SuppliersSeeder::class,
            SupplierProfilesSeeder::class,
            CustomersSeeder::class,
            RawMaterialsSeeder::class,
            ProductsSeeder::class,

            // recipes & usages depend on products & materials
            ProductRecipesSeeder::class,
            ProductUsagesSeeder::class,

            // procurement
            PurchaserOrdersSeeder::class,

            // operations / transactions
            DailyProductionsSeeder::class,
            SalesSeeder::class,
            InventoryLogsSeeder::class,
        ]);
    }
}
