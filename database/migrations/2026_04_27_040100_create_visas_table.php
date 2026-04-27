<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visa_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('image')->nullable();
            $table->string('country_ar');
            $table->string('country_en');
            $table->string('code_ar')->nullable();
            $table->string('code_en')->nullable();
            $table->string('processing_time_ar')->nullable();
            $table->string('processing_time_en')->nullable();
            $table->string('validity_ar')->nullable();
            $table->string('validity_en')->nullable();
            $table->decimal('price_old', 10, 2)->nullable();
            $table->decimal('price_from', 10, 2);
            $table->string('currency', 8)->default('USD');
            $table->unsignedTinyInteger('discount_percent')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('wa_text_ar')->nullable();
            $table->string('wa_text_en')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visas');
    }
};
