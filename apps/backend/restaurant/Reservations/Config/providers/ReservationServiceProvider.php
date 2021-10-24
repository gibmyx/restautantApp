<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Reservations\Config\providers;

use AppRestaurant\Restaurant\Reservations\Application\Subscriber\ReservationCreatedToCreateConfirmation;
use AppRestaurant\Restaurant\Reservations\Domain\Contract\ReservationRepository;
use AppRestaurant\Restaurant\Reservations\Domain\Event\ReservationCreated;
use AppRestaurant\Restaurant\Reservations\Infrastructure\Persistence\ReservationMysqlRepository;
use AppRestaurant\Restaurant\Tables\Domain\Contract\TableRepository;
use AppRestaurant\Restaurant\Tables\Infrastructure\Persistence\TableMysqlRepository;
use Illuminate\Support\ServiceProvider;

use function Lambdish\Phunctional\each;

final class ReservationServiceProvider extends ServiceProvider
{
    private $wiringObjects = [
        ReservationRepository::class => ReservationMysqlRepository::class
    ];

    protected $listen = [
        ReservationCreated::class => [
            ReservationCreatedToCreateConfirmation::class
        ],
    ];

    public function register()
    {
        //
    }


    public function boot()
    {
        each(function ($concrete, $abstract) {
            $this->app->bind(
                $abstract,
                $concrete
            );
        }, $this->wiringObjects);

    }
}
