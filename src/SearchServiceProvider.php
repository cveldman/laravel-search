<?php

namespace Veldman\Search;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Illuminate\Database\Eloquent\Builder::macro('search', function ($fields, $key = 'search') {

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
