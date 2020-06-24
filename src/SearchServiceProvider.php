<?php

namespace Veldman\Search;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class SearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'search');

        Blade::include('search::default', 'search');

        \Illuminate\Database\Eloquent\Builder::macro('search', function ($fields, $key = 'search') {
            if(request()->exists($key)) {
                $this->where($fields, 'like', '%' . request()->get($key) . '%');
            }

            return $this;
        });

        \Illuminate\Database\Query\Builder::macro('search', function ($fields, $key = 'search') {
            if(request()->exists($key)) {
                $this->where($fields, 'like', '%' . request()->get($key) . '%');
            }

            return $this;
        });
    }
}
