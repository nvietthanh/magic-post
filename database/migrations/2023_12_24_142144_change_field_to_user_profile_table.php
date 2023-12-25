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
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->date('birthday')
                ->after('gender')
                ->nullable();
        });
        Schema::table('admin_profiles', function (Blueprint $table) {
            $table->date('birthday')
                ->after('avatar')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_profiles', function (Blueprint $table) {
            $table->dropColumn('birthday');
        });
        Schema::table('admin_profiles', function (Blueprint $table) {
            $table->dropColumn('birthday');
        });
    }
};
