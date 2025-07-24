<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('category');
            $table->integer('in_stock')->nullable()->default(0);
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'name' => 'Product1',
                'price' => 99.99,
                'category' => 'cat1',
                'in_stock' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product2',
                'price' => 20.50,
                'category' => 'cat1',
                'in_stock' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product3',
                'price' => 10.99,
                'category' => 'cat1',
                'in_stock' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product4',
                'price' => 15.99,
                'category' => 'cat2',
                'in_stock' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Product5',
                'price' => 50.99,
                'category' => 'cat2',
                'in_stock' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
