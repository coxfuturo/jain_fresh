<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();

            $table->string('productId')->nullable();

            $table->string('name');

            $table->string('image')->nullable();

            $table->json('weight')->nullable();

            // PRODUCT INFORMATION
            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('delivery_time')->nullable();

            $table->string('shelf_life')->nullable();

            $table->string('stock_status')->nullable();

            // NUTRITION
            $table->text('nutrition')->nullable();

            // STORAGE TIPS
            $table->text('storage_tips')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
