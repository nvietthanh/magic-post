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
        Schema::table('order_statuses', function (Blueprint $table) {
            $table->foreignId('concentrate_point_id')
                ->nullable()
                ->after('note')
                ->constrained(table: 'concentrate_points')
                ->onDelete('cascade');
            $table->foreignId('transaction_point_id')
                ->nullable()
                ->after('note')
                ->constrained(table: 'transaction_points')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_statuses', function (Blueprint $table) {
            $table->dropForeign('order_statuses_concentrate_point_id_foreign');
            $table->dropForeign('order_statuses_transaction_point_id_foreign');
            $table->dropColumn('concentrate_point_id');
            $table->dropColumn('transaction_point_id');
        });
    }
};
