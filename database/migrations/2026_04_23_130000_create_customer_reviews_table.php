<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedTinyInteger('rating')->default(5);
            $table->text('quote_ar');
            $table->text('quote_en');
            $table->string('name_ar', 120);
            $table->string('name_en', 120);
            $table->string('from_city_ar', 120);
            $table->string('from_city_en', 120);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_reviews');
    }
};
