<?php

namespace App\Models;

use App\Http\Filters\v1\QueryFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeFilter($query, QueryFilter $filters)
    {
        return $filters->apply($query);
    }
}
