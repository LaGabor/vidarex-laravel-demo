<?php

namespace App\Providers;

use App\Http\Controllers\UserController;
use App\Models\QueryRepositories\DeviceRepository;
use App\Models\QueryRepositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository();
        });
        $this->app->bind(DeviceRepository::class, function ($app) {
            return new DeviceRepository();
        });
        $this->app->bind(UserController::class, function ($app) {
            return new UserController(new UserRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
