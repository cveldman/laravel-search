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

            // Set fields from model
            if($fields == null && isset($this->model->searchable)) {
                $fields = $this->model->searchable;
            }

            /* relation
            if (strpos($relation, '.') !== false) {
                return $this->hasNested($relation, $operator, $count, $boolean, $callback);
            }

            $relations = explode('.', $relations);

            whereHas('comments', function (Builder $query) {
                $query->where('content', 'like', 'foo%');
            })*/

            if(request()->exists($key)) {
                for($i = 0; $i < count($fields); $i++) {
                    if($i == 0) {
                        $this->where($fields[$i], 'like', '%' . request()->get($key) . '%');
                    } else {
                        $this->orWhere($fields[$i], 'like', '%' . request()->get($key) . '%');
                    }
                }
            }

            return $this;
        });

        \Illuminate\Database\Query\Builder::macro('search', function ($fields, $key = 'search') {

            // Set fields from model
            if($fields == null && isset($this->model->searchable)) {
                $fields = $this->model->searchable;
            }

            if(request()->exists($key)) {
                for($i = 0; $i < count($fields); $i++) {
                    if($i == 0) {
                        $this->where($fields[$i], 'like', '%' . request()->get($key) . '%');
                    } else {
                        $this->orWhere($fields[$i], 'like', '%' . request()->get($key) . '%');
                    }
                }
            }

            return $this;
        });
    }
}
