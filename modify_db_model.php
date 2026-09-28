<?php
// 1. Edit the migration file
$migrationFile = 'database/migrations/2026_09_26_084337_add_size_prices_to_products_table.php';
$migrationContent = file_get_contents($migrationFile);

$migrationContent = str_replace(
    'public function up(): void
    {
        Schema::table(\'products\', function (Blueprint $table) {
            //
        });
    }',
    'public function up(): void
    {
        Schema::table(\'products\', function (Blueprint $table) {
            $table->text(\'size_prices\')->nullable()->after(\'size\');
        });
    }',
    $migrationContent
);

$migrationContent = str_replace(
    'public function down(): void
    {
        Schema::table(\'products\', function (Blueprint $table) {
            //
        });
    }',
    'public function down(): void
    {
        Schema::table(\'products\', function (Blueprint $table) {
            $table->dropColumn(\'size_prices\');
        });
    }',
    $migrationContent
);

file_put_contents($migrationFile, $migrationContent);
echo "Migration updated.\n";

// 2. Edit the Product model
$modelFile = 'app/Models/Product.php';
$modelContent = file_get_contents($modelFile);
$modelContent = str_replace(
    "protected \$fillable = ['title', 'slug', 'summary', 'description', 'cat_id', 'child_cat_id', 'price', 'brand_id', 'discount', 'status', 'photo', 'size', 'stock', 'is_featured', 'condition'];",
    "protected \$fillable = ['title', 'slug', 'summary', 'description', 'cat_id', 'child_cat_id', 'price', 'brand_id', 'discount', 'status', 'photo', 'size', 'size_prices', 'stock', 'is_featured', 'condition'];",
    $modelContent
);
file_put_contents($modelFile, $modelContent);
echo "Model updated.\n";

?>
