<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_translations', function (Blueprint $table) {
            $table->id();
            $table->string('key', 255)->unique();
            $table->text('value_ar')->nullable();
            $table->text('value_en')->nullable();
            $table->string('group', 100)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('site_translations');
    }
};
