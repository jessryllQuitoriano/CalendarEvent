<?php

namespace App\Providers;

use App\Services\Repository\CalendarEventRepositoryInterface;
use App\Services\Repository\DBQuery\CalendarEventRepository;
use App\Services\Repository\DBQuery\EventDateRepository;
use App\Services\Repository\EventDateRepositoryInterface;
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
        $this->app->bind(CalendarEventRepositoryInterface::class, CalendarEventRepository::class);
        $this->app->bind(EventDateRepositoryInterface::class, EventDateRepository::class);
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
