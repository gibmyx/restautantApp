<?php

declare(strict_types=1);


namespace AppRestaurant\Restaurant\Shared\Infrastructure\Persistence;


use Illuminate\Database\Query\Builder;

class MysqlQueryFilters
{
    protected $request;

    protected $builder;

    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    public function __invoke(array $clause){
        foreach(array_filter($clause) as $key => $value){
            if(method_exists($this,$key)){
                call_user_func_array([$this, $key], array_filter([$value]));
            }
        }
        return $this->builder;
    }

    function getValue($value): array
    {
        return is_array($value) ? $value : [$value];
    }
}
