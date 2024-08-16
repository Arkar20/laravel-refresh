<?php

namespace App\Http\Filters\V1;


use App\Http\Filters\v1\QueryFilter;

class PodcastFilter extends QueryFilter
{

    public function status($value)
    {
        return $this->builder->where('status', $value);
    }
}
