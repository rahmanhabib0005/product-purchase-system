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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('order_no')->nullable();
            $table->timestamp('date')->nullable();
            $table->double('total')->nullable();
            $table->double('paid')->nullable();
            $table->double('due')->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->text('notes')->nullable();
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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
        });
        Schema::dropIfExists('orders');
    }
};
