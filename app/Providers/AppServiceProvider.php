<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function cacheVarible($value, $minutes)
    {
        if ($value == "cats") {
            $varible = Category::withCount('posts')->orderByDesc('posts_count')->get();
        } elseif ($value == "popular_posts") {
            $varible = Post::orderByDesc('views')->limit(4)->get();
        } else {
            $varible = Category::withCount('posts')->orderBy('posts_count', 'desc')->limit('4')->get(['slug', 'name']);
        }
        if (Cache::has($value)) {
            $varible = Cache::get($value);
            return $varible;
        } else {
            Cache::put($value, $varible, $minutes);
            return $varible;
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.includes.sidebar',
            function ($view) {
                $view->with('popular_posts', $this->cacheVarible('popular_posts', 60));
                $view->with('cats', $this->cacheVarible('cats', 60));
            }
        );
        view()->composer(
            'layouts.includes.header',
            function ($view) {
                $view->with('categories', $this->cacheVarible('categories', 60));
            }
        );
    }
}
