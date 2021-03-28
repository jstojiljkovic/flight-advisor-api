<?php

namespace App\Providers;

use App\Interfaces\Services\AirportServiceInterface;
use App\Interfaces\Services\CityServiceInterface;
use App\Interfaces\Services\CommentServiceInterface;
use App\Interfaces\Services\FlightServiceInterface;
use App\Interfaces\Services\GraphServiceInterface;
use App\Interfaces\Services\RouteServiceInterface;
use App\Interfaces\Services\UserServiceInterface;
use App\Services\AirportService;
use App\Services\CityService;
use App\Services\CommentService;
use App\Services\FlightService;
use App\Services\GraphService;
use App\Services\RouteService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CityServiceInterface::class, CityService::class);
        $this->app->bind(AirportServiceInterface::class, AirportService::class);
        $this->app->bind(RouteServiceInterface::class, RouteService::class);
        $this->app->bind(CommentServiceInterface::class, CommentService::class);
        $this->app->bind(FlightServiceInterface::class, FlightService::class);
        $this->app->bind(GraphServiceInterface::class, GraphService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
