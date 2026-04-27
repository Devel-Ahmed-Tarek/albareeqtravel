<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_slides', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('image', 2048);
            $table->string('image_label')->nullable();
            $table->string('kicker', 500)->nullable();
            $table->text('title_html');
            $table->text('lead_html');
            $table->string('primary_route', 64)->nullable();
            $table->string('primary_href', 2048)->nullable();
            $table->string('primary_label', 255)->nullable();
            $table->string('secondary_route', 64)->nullable();
            $table->string('secondary_href', 2048)->nullable();
            $table->string('secondary_label', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_slides');
    }
};
