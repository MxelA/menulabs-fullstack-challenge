<?php

namespace App\Providers;

use App\Repositories\BlockRepository\BlockRepository;
use App\Repositories\BlockRepository\IBlockRepository;
use App\Repositories\BookingRepository\BookingRepository;
use App\Repositories\BookingRepository\IBookingRepository;
use App\Repositories\RoomRepository\IRoomRepository;
use App\Repositories\RoomRepository\RoomRepository;
use App\Repositories\UserRepository\IUserRepository;
use App\Repositories\UserRepository\UserRepository;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
        /**
     * Register any events for your application.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
    }
}
