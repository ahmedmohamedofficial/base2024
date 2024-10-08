<?php

namespace App\Providers;

use App\Models\Social;
use App\Models\SiteSetting;
use App\Services\CacheService;
use App\Services\SettingService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Expression;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{

    protected $settings;
    protected $socials;

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        $this->loadMigrationsFrom([
            database_path() . '/migrations',
            database_path() . '/migrations/intro_site',
            database_path() . '/migrations/settings',
            database_path() . '/migrations/chat',
            database_path() . '/migrations/admin',
        ]);

        try {
            $this->socials = Cache::rememberForever('socials', function () {
                return Social::get();
            });

        } catch (Exception $e) {
            echo('app service provider exception :::::::::: ' . $e->getMessage());
        }

        view()->composer('admin.*', function ($view) {
            $view->with([
                'settings'   => (new CacheService())->Settings(),
                'adminLogin' => Auth::guard('admin')->user()
            ]);
        });

        // -------------- lang ---------------- \\
        app()->singleton('lang', function () {
            if (session()->has('lang')) {
                return session('lang');
            } else {
                return 'ar';
            }
        });
        Builder::macro('whereLike', function ($attributes, $searchTerm) {
            return $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (Arr::wrap($attributes) as $attribute) {
                    $query->when(
                    // Check if the attribute is not an expression and contains a dot (indicating a related model)
                        !($attribute instanceof Expression) &&
                        str_contains((string)$attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            // Split the attribute into a relation and related attribute
                            $parts            = explode('.', (string)$attribute);
                            $relation         = implode('.', array_slice($parts, 0, -1));
                            $relatedAttribute = end($parts);
                            // Perform a 'LIKE' search on the related model's attribute
                            $query->orWhereHas($relation, function (Builder $query) use ($relatedAttribute, $searchTerm) {
                                $query->where($relatedAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            // Perform a 'LIKE' search on the current model's attribute
                            // also attribute can be an expression
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });
        });
    }

}
