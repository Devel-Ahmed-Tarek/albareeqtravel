<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo_path', 2048)->nullable();
            $table->string('favicon_path', 2048)->nullable();
            $table->string('site_name_ar', 255)->nullable();
            $table->string('site_name_en', 255)->nullable();
            $table->text('default_meta_ar')->nullable();
            $table->text('default_meta_en')->nullable();
            $table->string('phone_primary', 64)->nullable();
            $table->string('phone_secondary', 64)->nullable();
            $table->string('whatsapp_number', 32)->nullable();
            $table->string('contact_email', 255)->nullable();
            $table->string('social_facebook', 2048)->nullable();
            $table->string('social_instagram', 2048)->nullable();
            $table->string('social_x', 2048)->nullable();
            $table->string('social_linkedin', 2048)->nullable();
            $table->string('social_tiktok', 2048)->nullable();
            $table->string('social_youtube', 2048)->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
