<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\NewsItem;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $content = implode("\n", [
            'User-agent: *',
            'Allow: /',
            'Sitemap: '.url('/sitemap.xml'),
            '',
        ]);

        return response($content, 200, ['Content-Type' => 'text/plain; charset=UTF-8']);
    }

    public function sitemap(): Response
    {
        $xml = Cache::remember('seo:sitemap:xml', now()->addMinutes(30), function (): string {
            $now = now()->toAtomString();

            $static = [
                '',
                'about',
                'programs',
                'hotels',
                'destinations',
                'visas',
                'offers',
                'blog',
                'news',
            ];

            $urls = [];

            foreach (['', 'en'] as $prefix) {
                foreach ($static as $path) {
                    $fullPath = trim(($prefix !== '' ? $prefix.'/' : '').$path, '/');
                    $urls[] = [
                        'loc' => url($fullPath === '' ? '/' : '/'.$fullPath),
                        'lastmod' => $now,
                    ];
                }
            }

            $posts = BlogPost::query()->published()->get(['slug', 'updated_at']);
            foreach (['', 'en'] as $prefix) {
                foreach ($posts as $post) {
                    $fullPath = trim(($prefix !== '' ? $prefix.'/' : '').'blog/'.$post->slug, '/');
                    $urls[] = [
                        'loc' => url('/'.$fullPath),
                        'lastmod' => optional($post->updated_at)->toAtomString() ?? $now,
                    ];
                }
            }

            $news = NewsItem::query()->published()->get(['slug', 'updated_at']);
            foreach (['', 'en'] as $prefix) {
                foreach ($news as $item) {
                    $fullPath = trim(($prefix !== '' ? $prefix.'/' : '').'news/'.$item->slug, '/');
                    $urls[] = [
                        'loc' => url('/'.$fullPath),
                        'lastmod' => optional($item->updated_at)->toAtomString() ?? $now,
                    ];
                }
            }

            $rows = array_map(static function (array $u): string {
                return "<url><loc>{$u['loc']}</loc><lastmod>{$u['lastmod']}</lastmod></url>";
            }, $urls);

            return '<?xml version="1.0" encoding="UTF-8"?>'
                .'<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
                .implode('', $rows)
                .'</urlset>';
        });

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
