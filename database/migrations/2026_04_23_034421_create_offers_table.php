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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->string('badge_ar')->nullable();
            $table->string('badge_en')->nullable();
            $table->string('valid_note_ar')->nullable();
            $table->string('valid_note_en')->nullable();
            $table->string('wa_text_ar')->nullable();
            $table->string('wa_text_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
