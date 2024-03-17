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
            $table->unsignedBigInteger('user_id'); // Foreign key referencing the 'users' table
            $table->decimal('total_amount', 10, 2); // Total amount for the order
            $table->enum('status', ['Pending', 'Packed', 'Dispatched', 'Delivered']); // Order status

            $table->enum('delivery_option', ['Home Delivery', 'Cash on Delivery']); // Delivery option
            $table->string('proof_of_payment')->nullable(); // URL or file reference for proof of payment
            $table->timestamps();

            // Define the foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
           

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
