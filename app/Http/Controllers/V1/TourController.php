<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Request\TourListRequest;
use App\Http\Resources\V1\TourListResource;
use App\Services\V1\TourService;

class TourController extends Controller
{
    public function __construct(private TourService $tourService)
    {
    }

    public function all(TourListRequest $request)
    {
        $tours = $this->tourService->list($request->all());

        return TourListResource::collection($tours);
    }
}
