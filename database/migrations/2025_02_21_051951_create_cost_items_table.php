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
        Schema::create('cost_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->double('qty')->nullable();
            $table->double('unit_price')->nullable();
            $table->string('order_no')->nullable();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cost_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['supplier_id']);
        });
        Schema::dropIfExists('cost_items');
    }
};
