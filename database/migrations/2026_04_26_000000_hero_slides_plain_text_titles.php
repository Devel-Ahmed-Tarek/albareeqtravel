<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('hero_slides')) {
            return;
        }

        if (! Schema::hasColumn('hero_slides', 'title_html_ar')) {
            return;
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->text('title_ar')->nullable();
            $table->text('title_en')->nullable();
            $table->text('lead_ar')->nullable();
            $table->text('lead_en')->nullable();
        });

        $rows = DB::table('hero_slides')->get();
        foreach ($rows as $row) {
            DB::table('hero_slides')->where('id', $row->id)->update([
                'title_ar' => self::plainFromHtml($row->title_html_ar ?? null),
                'title_en' => self::plainFromHtml($row->title_html_en ?? null),
                'lead_ar' => self::plainFromHtml($row->lead_html_ar ?? null),
                'lead_en' => self::plainFromHtml($row->lead_html_en ?? null),
            ]);
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn([
                'title_html_ar',
                'title_html_en',
                'lead_html_ar',
                'lead_html_en',
            ]);
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('hero_slides')) {
            return;
        }

        if (! Schema::hasColumn('hero_slides', 'title_ar')) {
            return;
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->text('title_html_ar')->nullable();
            $table->text('title_html_en')->nullable();
            $table->text('lead_html_ar')->nullable();
            $table->text('lead_html_en')->nullable();
        });

        $rows = DB::table('hero_slides')->get();
        foreach ($rows as $row) {
            DB::table('hero_slides')->where('id', $row->id)->update([
                'title_html_ar' => e($row->title_ar ?? ''),
                'title_html_en' => e($row->title_en ?? ''),
                'lead_html_ar' => e($row->lead_ar ?? ''),
                'lead_html_en' => e($row->lead_en ?? ''),
            ]);
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn(['title_ar', 'title_en', 'lead_ar', 'lead_en']);
        });
    }

    protected static function plainFromHtml(?string $html): ?string
    {
        if ($html === null || $html === '') {
            return null;
        }

        $t = strip_tags($html);
        $t = html_entity_decode($t, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $t = preg_replace("/\xC2\xA0/u", ' ', $t) ?? $t;
        $t = preg_replace('/\s+/u', ' ', $t) ?? $t;

        return trim($t) === '' ? null : trim($t);
    }
};
