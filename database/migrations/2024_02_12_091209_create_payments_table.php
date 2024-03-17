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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign key referencing the 'orders' table
            $table->decimal('amount', 10, 2); // Payment amount
            $table->string('method'); // Payment method (e.g., Esewa, other online platforms)
            $table->string('transaction_id'); // Transaction ID provided by the payment gateway
            $table->timestamps();

            // Define the foreign key constraint
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
