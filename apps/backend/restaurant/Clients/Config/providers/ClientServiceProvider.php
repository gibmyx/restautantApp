<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\Clients\Config\providers;

use AppRestaurant\Restaurant\Clients\Domain\Contract\ClientRepository;
use AppRestaurant\Restaurant\Clients\Infrastructure\Persistence\ClientMysqlRepository;
use Illuminate\Support\ServiceProvider;

use function Lambdish\Phunctional\each;

final class ClientServiceProvider extends ServiceProvider
{
    private $wiringObjects = [
        ClientRepository::class => ClientMysqlRepository::class
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
