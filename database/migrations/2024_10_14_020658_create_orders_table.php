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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->enum('status', ['Chờ xác nhận', 'Đang giao', 'Đã giao', 'Đã hủy'])->default('Chờ xác nhận');            $table->decimal('total', 10, 2); // tổng số tiền
            $table->string('payment_method')->nullable(); // phương thức thanh toán

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
