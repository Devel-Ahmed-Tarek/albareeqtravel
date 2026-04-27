<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hotel_showcase_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('image', 2048)->default('');
            $table->string('image_path', 2048)->nullable();
            $table->string('title_ar', 255);
            $table->string('title_en', 255);
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->string('badge_ar', 120)->nullable();
            $table->string('badge_en', 120)->nullable();
            $table->string('link_route', 64)->nullable();
            $table->string('link_href_ar', 2048)->nullable();
            $table->string('link_href_en', 2048)->nullable();
            $table->text('wa_prefill_ar')->nullable();
            $table->text('wa_prefill_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_showcase_slides');
    }
};
