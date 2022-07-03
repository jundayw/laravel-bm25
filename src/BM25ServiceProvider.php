<?php

namespace Jundayw\LaravelBM25;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Jundayw\LaravelBM25\Contracts\BM25 as BM25Contract;
use Jundayw\LaravelBM25\Extensions\BM25 as BM25Extension;

class BM25ServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(BM25Contract::class, function() {
            return new BM25Extension();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
