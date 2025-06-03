<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Supplier;
use App\Observers\CategoryObserver;
use App\Observers\SupplierObserver;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Builder::macro('getSql', fn() => getSql($this));
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {


        $this->registerObservers();
    }

    private function registerObservers(): void
    {
        Category::observe(CategoryObserver::class);
        Supplier::observe(SupplierObserver::class);
    }
}
