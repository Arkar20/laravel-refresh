<?php

namespace App\Http\Filters\V1;


use App\Http\Filters\v1\QueryFilter;
use Illuminate\Contracts\Database\Eloquent\Builder;

class PodcastFilter extends QueryFilter
{
    public function status($value): Builder
    {
        return $this->builder->whereIn('status', explode(',', $value));
    }

    public function name(string $value): Builder
    {
        return $this->builder->where('name', 'LIKE', '%' . $value . '%');
    }
}
