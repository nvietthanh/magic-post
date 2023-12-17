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
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')
                ->nullable()
                ->constrained(table: 'orders')
                ->onDelete('cascade');
            $table->integer('type')->default(0);
            $table->boolean('status')->default(1);
            $table->string('reason_for_refusal')->nullable();
            $table->string('note')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_statuses');
    }
};
