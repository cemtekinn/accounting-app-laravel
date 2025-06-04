<?php

namespace App\Providers;

use App\Core\DataTable\BaseDataTable;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Observers\CategoryObserver;
use App\Observers\ProductObserver;
use App\Observers\SupplierObserver;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        Builder::macro('getSql', fn() => getSql($this));

        Route::macro(
            'customResource',
            fn($name, $controller, $group = null, $includeResources = true) => customResources(
                name: $name,
                controller: $controller,
                group: $group,
                includeResources: $includeResources
            )
        );

        $this->app->bind(BaseDataTable::class, fn() => $this->app->make(BaseDataTable::class));


        $this->registerObservers();
    }

    private function registerObservers(): void
    {
        Product::observe(ProductObserver::class);

        Category::observe(CategoryObserver::class);
        Supplier::observe(SupplierObserver::class);
    }
}
