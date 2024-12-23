<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Gate untuk admin
        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });

        // Gate untuk pegawai
        Gate::define('pegawai', function (User $user) {
            return $user->role === 'pegawai';
        });

        // Gate untuk pegawai
        Gate::define('user', function (User $user) {
            return $user->role === 'user';
        });
    }
}
