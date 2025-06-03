<?php

use Illuminate\Routing\RouteRegistrar;
use App\Models\SystemSetting;
use Illuminate\Support\Str;

if (!function_exists('getSql')) {
    function getSql($builder): string
    {
        $addSlashes = str_replace('?', "'?'", $builder->toSql());
        return vsprintf(str_replace('?', '%s', $addSlashes), $builder->getBindings());
    }
}

if (!function_exists('setting')) {
    function setting($key)
    {
        try {
            return SystemSetting::take($key)->value;
        } catch (Exception $e) {
            return null;
        }
    }
}

if (!function_exists('getIp')) {
    function getIp(): string
    {
        return ($_SERVER['HTTP_CF_CONNECTING_IP'] ?? request()->ip());
    }
}

if (!function_exists('customResources')) {
    function customResources(string $name, string $controller, callable|array|null $group = null, bool $includeResources = true): RouteRegistrar
    {
        $http_methods = ['get', 'post', 'put', 'delete', 'options', 'patch', 'head', 'trace', 'any'];
        $controller_methods = array_intersect(get_class_methods($controller), ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);

        if (is_array($group)) {
            $group = static function () use ($controller, $http_methods, $group) {
                foreach ($group as $route => $method) {
                    if (is_string($method) && in_array($method, $http_methods, true)) {
                        Route::$method(Str::slug($route), Str::camel($route))->name(Str::slug($route));
                    } else if (is_string($route) && is_callable($method)) {
                        Route::prefix($route)->group($method);
                    } else if (is_array($method)) {
                        customResources(
                            name: $route,
                            controller: $controller,
                            group: $method,
                            includeResources: false
                        );
                    }
                }
            };
        }

        $customRoutes = Route::prefix($name)->controller($controller);

        if (!str_starts_with($name, '{') && !str_ends_with($name, '}')) $customRoutes->name($name . '.');

        if (is_callable($group)) $customRoutes->group($group);

        if (!empty($controller_methods) && $includeResources) Route::resource($name, $controller)->only($controller_methods);

        return $customRoutes;
    }
}
