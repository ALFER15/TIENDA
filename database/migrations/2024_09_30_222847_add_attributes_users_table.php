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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->longText('address')->nullable()->default(null);
            $table->date('hire')->nullable()->default(null);
            $table->date('end')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {



            $table->dropColumn('address');
            $table->dropColumn('hire');
            $table->dropColumn('end');
        });
    }
};
