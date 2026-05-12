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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->unsignedBigInteger('address_id');

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('cascade');

            $table->decimal('subtotal', 10, 2)->default(0);

            $table->decimal('discount_amount', 10, 2)->default(0);

            $table->decimal('total_amount', 10, 2)->default(0);

            $table->string('payment_method')->nullable();

            $table->string('payment_status')->default('Pending');

            $table->string('order_status')->default('Pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
