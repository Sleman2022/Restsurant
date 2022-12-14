<?php

namespace App\Providers;

use App\Services\Implementations\CategoryService;
use App\Services\Implementations\ItemService;
use App\Services\Implementations\MenusService;
use App\Services\Implementations\UsersService;
use App\Services\Interfaces\ICategoryService;
use App\Services\Interfaces\IItemService;
use App\Services\Interfaces\IMenuService;
use App\Services\Interfaces\IUsersService;
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
        //
        $this->app->bind(IUsersService::class, UsersService::class);
        $this->app->bind(IMenuService::class, MenusService::class);
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IItemService::class, ItemService::class);
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
