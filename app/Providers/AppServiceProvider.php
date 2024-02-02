<?php

namespace App\Providers;

use App\Repository\AssetRepository;
use App\Repository\DashboardRepository;
use App\Repository\IAssetRepository;
use App\Repository\IDashboardRepository;
use App\Repository\ILocationRepository;
use App\Repository\IUserRepository;
use App\Repository\LocationRepository;
use App\Repository\UserRepository;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(ILocationRepository::class, LocationRepository::class);
        $this->app->bind(IAssetRepository::class, AssetRepository::class);
        $this->app->bind(IDashboardRepository::class, DashboardRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
    }
}
