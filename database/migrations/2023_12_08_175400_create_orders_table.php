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
            $table->foreignId('admin_id')
                ->nullable()
                ->constrained(table: 'admins')
                ->onDelete('cascade');
            $table->foreignId('user_id')
                ->nullable()
                ->constrained(table: 'users')
                ->onDelete('cascade');
            $table->string('order_code');
            $table->enum('type', [1, 2])->comment('1: Document, 2: GOODS')->default(1);
            $table->string('full_name');
            $table->string('phone_number');
            $table->foreignId('receive_district_id')
                ->nullable()
                ->constrained(table: 'districts')
                ->onDelete('cascade');
            $table->foreignId('delivery_district_id')
                ->nullable()
                ->constrained(table: 'districts')
                ->onDelete('cascade');
            $table->string('address')->nullable();
            $table->string('note')->nullable();
            $table->enum('guide', [1, 2, 3, 4, 5])->nullable();;
            $table->timestamps();
            $table->softDeletes();
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
