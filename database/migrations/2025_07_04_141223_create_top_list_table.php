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
        Schema::create('top_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('brand_id')->on('brands')->onDelete('cascade');
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->integer('rating');
            $table->text('bonus')->nullable();
            $table->timestamps();

            $table->unique(['brand_id', 'country_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_lists');
    }
};
