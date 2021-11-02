<?php

namespace BloomCU\Categories;

use Illuminate\Support\ServiceProvider;

class CategoriesServiceProvider extends ServiceProvider
{
    public function register()
    {
        
    }

    public function boot()
    {
        // Register migrations
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
    }
}
