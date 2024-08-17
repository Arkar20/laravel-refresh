<?php

namespace App\Http\Filters\v1;

use Illuminate\Contracts\Database\Eloquent\Builder;

abstract class QueryFilter
{
    protected  $builder;

    protected function filter(array $methods)
    {
        foreach ($methods as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }

    public function apply($builder): Builder
    {
        $this->builder = $builder;

        foreach (request()->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $this->builder;
    }
}
