<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Podcast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Filters\V1\PodcastFilter;

class PodCastApiController extends Controller
{
    public function index(PodcastFilter $filters)
    {
        $podcasts = Podcast::filter($filters)->get();

        return $podcasts;
    }
}
