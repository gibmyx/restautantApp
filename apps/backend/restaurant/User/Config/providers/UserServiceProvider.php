<?php

declare(strict_types=1);

namespace Apps\Backend\restaurant\User\Config\providers;

use AppRestaurant\Restaurant\User\Domain\Contract\UserRepository;
use AppRestaurant\Restaurant\User\Infrastructure\Persistence\UserMysqlRepository;
use Illuminate\Support\ServiceProvider;

use function Lambdish\Phunctional\each;

final class UserServiceProvider extends ServiceProvider
{
    private $wiringObjects = [
        UserRepository::class => UserMysqlRepository::class
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
