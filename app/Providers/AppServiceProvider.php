<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

use App\Repository\ChatRepositoryImpl ;
use App\Repository\ChatRepository ;

use App\Repository\UserRepository ;
use App\Repository\UserRepository_Impl ;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ChatRepository::class,
            ChatRepositoryImpl::class
        );
        $this->app->bind(
            UserRepository::class,
            UserRepository_Impl::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
