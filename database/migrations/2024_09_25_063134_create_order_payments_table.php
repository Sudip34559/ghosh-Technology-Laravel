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
        Schema::create('order_payments', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_boy'); // Delivery person name or ID
            $table->enum('payment_type', ['cash', 'online']); // Payment type
            $table->enum('payment_status', ['partially', 'fullpaid', 'adjusted']); // Payment status
            $table->decimal('amount', 10, 2); // Payment amount (decimal with 2 decimal places)
            $table->date('payment_date'); // Payment date
            $table->timestamps(); // Created_at and Updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_payments');
    }
};
