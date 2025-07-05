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
        Schema::table('top_lists', function (Blueprint $table) {
            $table->dropColumn(['rating', 'bonus']);
            $table->integer('position')->after('country_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('top_lists', function (Blueprint $table) {
            $table->integer('rating');
            $table->text('bonus')->nullable();
            $table->dropColumn('position');
        });
    }
};
