<?php

namespace App\Http\Filters\v1;

abstract class QueryFilter
{
    protected $builder;

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach (request()->all() as $key => $value) {
            $this->$key($value);
        }

        return $this->builder;
    }
}
