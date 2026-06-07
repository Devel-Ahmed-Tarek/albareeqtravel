<?php

use App\Http\Controllers\PublicContentController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::middleware('public.cache')->group(function (): void {
    Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
    Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
});

$registerSiteRoutes = function (): void {
    Route::get('/', [PublicContentController::class, 'home'])->name('home');
    Route::view('/about', 'pages.about')->name('about');
    Route::get('/programs', [PublicContentController::class, 'programs'])->name('programs');
    Route::get('/hotels', [PublicContentController::class, 'hotels'])->name('hotels');
    Route::get('/destinations', [PublicContentController::class, 'destinations'])->name('destinations');
    Route::get('/visas', [PublicContentController::class, 'visas'])->name('visas');
    // Route::get('/blog', [PublicContentController::class, 'blogIndex'])->name('blog');
    // Route::get('/blog/{slug}', [PublicContentController::class, 'blogShow'])->name('blog.show');
    // Route::get('/news', [PublicContentController::class, 'newsIndex'])->name('news');
    // Route::get('/news/{slug}', [PublicContentController::class, 'newsShow'])->name('news.show');
    Route::get('/offers', [PublicContentController::class, 'offersPage'])->name('offers');
};

Route::middleware(['public.cache', 'locale:ar'])->group($registerSiteRoutes);
Route::prefix('en')->name('en.')->middleware(['public.cache', 'locale:en'])->group($registerSiteRoutes);
