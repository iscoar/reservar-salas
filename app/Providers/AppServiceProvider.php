<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\Booking\Domain\{BookingRepositoryInterface, BookingRepository};
use Src\Common\Responders\{ErrorResponderInterface, ErrorResponder};
use Src\Common\Responders\{SuccessResponderInterface, SuccessResponder};
use Src\MeetingRoom\Domain\{MeetingRoomRepositoryInterface, MeetingRoomRepository};

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
            ErrorResponderInterface::class,
            ErrorResponder::class
        );
        $this->app->bind(
            SuccessResponderInterface::class,
            SuccessResponder::class
        );
        $this->app->bind(
            MeetingRoomRepositoryInterface::class,
            MeetingRoomRepository::class
        );
        $this->app->bind(
            BookingRepositoryInterface::class,
            BookingRepository::class
        );
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
