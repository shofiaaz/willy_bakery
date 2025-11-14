# Willy Bakery - AI Coding Agent Instructions

## Project Overview
**Willy Bakery** is a Laravel 12 web application for managing a bakery's operations, including inventory management, product recipes, supplier orders, sales tracking, production scheduling, and reporting.

## Architecture

### Core Data Model
The system revolves around three main entities:
- **Products** (`app/Models/Product.php`): Bakery items with recipes (uses `ProductRecipe`)
- **Raw Materials** (`app/Models/RawMaterial.php`): Ingredients with stock tracking
- **Sales & Purchases**: Products sold to customers; raw materials purchased from suppliers

**Key Pattern**: Custom primary keys (e.g., `product_id`, `material_id`, `user_id`) instead of `id`. Always inspect model definitions for the correct primary key name.

### Major Components

1. **Inventory Management**: `RawMaterial` → `ProductUsage` (consumed) → `InventoryLog` (tracked)
2. **Production Pipeline**: `ProductRecipe` (defines what materials → `DailyProduction` (records output)
3. **Supply Chain**: `Supplier` → `PurchaserOrder` (main order) → `PurchaserOrderItem` (line items)
4. **Sales Module**: `Customer` → `Sale` (transaction) → `Product` (what was sold)
5. **Reporting**: `Report`, `ForecastResult` models for analytics

### User & Activity Tracking
- `User` (auth model, `role` field for permissions)
- `UserProfile`, `UserActivityLog` for audit trails
- Auth controller uses owner prefix: `app/Http/Controllers/Owner/AuthController.php`

## Database Schema Insights
- Uses **Laravel migrations** in `database/migrations/`
- Custom timestamps: Most models have `public $timestamps = true`, but `ProductRecipe` and `User` use `false`
- Foreign keys follow pattern: `{related_model}_id` (e.g., `product_id`, `supplier_id`)

## Controllers & Routing

**Route Prefix**: All main application routes are under `/owner` prefix (`routes/web.php`)

**Controller Organization** (`app/Http/Controllers/Owner/`):
- `AuthController`: Login/logout (custom authentication)
- `DashboardController`: Main dashboard with filtering
- `SupplierController`: CRUD operations for suppliers
- `PurchaserOrderController`: Order management (resource-based)
- `SaleController`: Sales transactions (resource-based)
- `ReportController`: PDF/Excel exports with type parameter (e.g., `/reports/pdf/{type}`)

**Pattern**: Controllers use Laravel resource conventions; inspect route definitions for filter endpoints.

## Development Setup & Workflows

### Initial Setup
```bash
composer run-script setup
```
This handles: dependencies, `.env` creation, key generation, migrations, npm install, and build.

### Development Server
```bash
composer run dev
```
Runs **concurrently**: Laravel server (port 8000), queue listener, and Vite dev server (watch mode).

### Testing
```bash
composer run test
```
Uses **Pest** (pestphp/pest 4.1+) with Laravel plugin. Tests in `tests/` directory.

### Build & Asset Management
- **Vite** 7.0.7 with Laravel plugin for asset compilation
- **Tailwind CSS** 4.0.0 via `@tailwindcss/vite` plugin
- Entry points: `resources/css/app.css`, `resources/js/app.js`
- **vite.config.js**: Configured with refresh: true for auto-reload

## Project-Specific Patterns

### Model Relationships
- Always use custom primary keys in relationship definitions:
  ```php
  return $this->belongsTo(Product::class, 'product_id');  // Correct
  // NOT: belongsTo(Product::class) - would default to 'product_id' anyway, be explicit
  ```

### Exports & Reports
- `app/Exports/GenericExport.php`: Generic base class for Excel exports (inspect for structure)
- Reports support PDF (dompdf via `barryvdh/laravel-dompdf`) and Excel (maatwebsite/excel 3.1)

### Dependencies
- **PHP 8.2+**: Type hints and modern syntax expected
- **Key Packages**: 
  - `barryvdh/laravel-dompdf` (PDF generation)
  - `maatwebsite/excel` (Excel export)
  - `laravel/tinker` (REPL)
  - Pest for testing (not PHPUnit)

### Naming Conventions
- Migration timestamps: `YYYY_MM_DD_HHMMSS` format
- Models: CamelCase (e.g., `ProductRecipe`, `PurchaserOrder`)
- Controllers: Organized under `Owner/` subdirectory with suffix `Controller`

## Common Workflows

### Adding a New Feature
1. Create migration: `php artisan make:migration create_table_name`
2. Create model: `php artisan make:model ModelName`
3. Define relationships in model class
4. Create controller: `php artisan make:controller Owner/FeatureController --resource`
5. Add routes to `routes/web.php` under `/owner` prefix
6. Build views in `resources/views/`
7. Test with Pest in `tests/Feature/` or `tests/Unit/`

### Updating Inventory
- Always reference `InventoryLog` model for audit trail
- Use `ProductRecipe` to calculate material requirements
- Update `RawMaterial.stock` and `Product.stock` atomically with log entries

### Dashboard Filtering
- `DashboardController::filter()` handles POST requests (see route definition)
- Inspect `DashboardController::index()` for available filters

## File References
- **Models**: `app/Models/{ModelName}.php`
- **Controllers**: `app/Http/Controllers/Owner/{FeatureController}.php`
- **Migrations**: `database/migrations/YYYY_MM_DD_HHMMSS_*.php`
- **Tests**: `tests/Feature/` or `tests/Unit/`
- **Routes**: `routes/web.php`
- **Views**: `resources/views/` (check structure based on controller names)
- **Configuration**: `config/` (app.php, database.php, etc.)

## Known Constraints
- Timestamps: Check if `$timestamps` is true/false per model before setting created_at/updated_at
- Factories: Only `UserFactory` exists; create new factories for seeding as needed
- No queue jobs defined yet; queue listener runs but no Job classes found
- Reports are exported, not stored; inspect ReportController for export types
