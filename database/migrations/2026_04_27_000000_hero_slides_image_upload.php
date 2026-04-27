<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('hero_slides')) {
            return;
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('image_path', 2048)->nullable()->after('image');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('hero_slides') || ! Schema::hasColumn('hero_slides', 'image_path')) {
            return;
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn('image_path');
        });
    }
};
