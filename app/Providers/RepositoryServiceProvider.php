<?php

namespace App\Providers;

use App\Interfaces\Repositories\AirportRepositoryInterface;
use App\Interfaces\Repositories\CityRepositoryInterface;
use App\Interfaces\Repositories\CommentRepositoryInterface;
use App\Interfaces\Repositories\RoleRepositoryInterface;
use App\Interfaces\Repositories\RouteRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\EloquentAirportRepository;
use App\Repositories\EloquentCityRepository;
use App\Repositories\EloquentCommentRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\EloquentRouteRepository;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, EloquentRoleRepository::class);
        $this->app->bind(CityRepositoryInterface::class, EloquentCityRepository::class);
        $this->app->bind(AirportRepositoryInterface::class, EloquentAirportRepository::class);
        $this->app->bind(RouteRepositoryInterface::class, EloquentRouteRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, EloquentCommentRepository::class);
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
