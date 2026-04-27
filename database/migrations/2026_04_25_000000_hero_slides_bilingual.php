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

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('image_label_ar')->nullable();
            $table->string('image_label_en')->nullable();
            $table->string('kicker_ar', 500)->nullable();
            $table->string('kicker_en', 500)->nullable();
            $table->text('title_html_ar')->nullable();
            $table->text('title_html_en')->nullable();
            $table->text('lead_html_ar')->nullable();
            $table->text('lead_html_en')->nullable();
            $table->string('primary_label_ar', 255)->nullable();
            $table->string('primary_label_en', 255)->nullable();
            $table->string('secondary_label_ar', 255)->nullable();
            $table->string('secondary_label_en', 255)->nullable();
            $table->string('primary_href_ar', 2048)->nullable();
            $table->string('primary_href_en', 2048)->nullable();
            $table->string('secondary_href_ar', 2048)->nullable();
            $table->string('secondary_href_en', 2048)->nullable();
        });

        if (Schema::hasColumn('hero_slides', 'kicker')) {
            $rows = DB::table('hero_slides')->get();
            foreach ($rows as $row) {
                DB::table('hero_slides')->where('id', $row->id)->update([
                    'image_label_ar' => $row->image_label,
                    'image_label_en' => $row->image_label,
                    'kicker_ar' => $row->kicker,
                    'kicker_en' => $row->kicker,
                    'title_html_ar' => $row->title_html,
                    'title_html_en' => $row->title_html,
                    'lead_html_ar' => $row->lead_html,
                    'lead_html_en' => $row->lead_html,
                    'primary_label_ar' => $row->primary_label,
                    'primary_label_en' => $row->primary_label,
                    'secondary_label_ar' => $row->secondary_label,
                    'secondary_label_en' => $row->secondary_label,
                    'primary_href_ar' => $row->primary_href,
                    'primary_href_en' => $row->primary_href,
                    'secondary_href_ar' => $row->secondary_href,
                    'secondary_href_en' => $row->secondary_href,
                ]);
            }
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            if (Schema::hasColumn('hero_slides', 'image_label')) {
                $table->dropColumn([
                    'image_label',
                    'kicker',
                    'title_html',
                    'lead_html',
                    'primary_label',
                    'secondary_label',
                    'primary_href',
                    'secondary_href',
                ]);
            }
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('hero_slides')) {
            return;
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->string('image_label')->nullable();
            $table->string('kicker', 500)->nullable();
            $table->text('title_html')->nullable();
            $table->text('lead_html')->nullable();
            $table->string('primary_label', 255)->nullable();
            $table->string('secondary_label', 255)->nullable();
            $table->string('primary_href', 2048)->nullable();
            $table->string('secondary_href', 2048)->nullable();
        });

        if (Schema::hasColumn('hero_slides', 'kicker_ar')) {
            $rows = DB::table('hero_slides')->get();
            foreach ($rows as $row) {
                DB::table('hero_slides')->where('id', $row->id)->update([
                    'image_label' => $row->image_label_ar,
                    'kicker' => $row->kicker_ar,
                    'title_html' => $row->title_html_ar,
                    'lead_html' => $row->lead_html_ar,
                    'primary_label' => $row->primary_label_ar,
                    'secondary_label' => $row->secondary_label_ar,
                    'primary_href' => $row->primary_href_ar,
                    'secondary_href' => $row->secondary_href_ar,
                ]);
            }
        }

        Schema::table('hero_slides', function (Blueprint $table) {
            $table->dropColumn([
                'image_label_ar', 'image_label_en',
                'kicker_ar', 'kicker_en',
                'title_html_ar', 'title_html_en',
                'lead_html_ar', 'lead_html_en',
                'primary_label_ar', 'primary_label_en',
                'secondary_label_ar', 'secondary_label_en',
                'primary_href_ar', 'primary_href_en',
                'secondary_href_ar', 'secondary_href_en',
            ]);
        });
    }
};
