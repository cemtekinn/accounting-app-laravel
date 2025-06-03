<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $repositories = collect(File::glob(app_path('/Repositories/*.php')))
            ->map(fn($file) => Str::studly(basename($file, '.php')));

        foreach ($repositories as $repository) {
            $this->app->bind(
                'App\\Repositories\\' . $repository,
                function ($app) use ($repository) {
                    $modelName = str_replace('Repository', '', $repository);
                    $modelClass = 'App\\Models\\' . $modelName;
                    $modelInstance = new $modelClass();

                    $repositoryClass = 'App\\Repositories\\' . $repository;
                    return new $repositoryClass($modelInstance);
                }
            );
        }
    }

    public function boot()
    {
    }
}
