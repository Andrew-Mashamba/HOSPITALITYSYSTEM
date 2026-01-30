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
            $table->foreignId('guest_id')->constrained('guests')->onDelete('cascade');
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade');
            $table->foreignId('waiter_id')->constrained('staff')->onDelete('cascade');
            $table->foreignId('session_id')->nullable()->constrained('guest_sessions')->onDelete('set null');
            $table->enum('status', [
                'pending',
                'confirmed',
                'preparing',
                'ready',
                'served',
                'completed',
                'cancelled'
            ])->default('pending');
            $table->enum('order_source', ['whatsapp', 'pos', 'web'])->default('pos');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('service_charge', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index('guest_id');
            $table->index('table_id');
            $table->index('waiter_id');
            $table->index('status');
            $table->index('order_source');
            $table->index('created_at');
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
