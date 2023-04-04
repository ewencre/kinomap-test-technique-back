<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ActivityController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return ActivityResource::collection(Activity::paginate(5));
    }
    
    /**
     * @param int $activityId
     * 
     * @return ActivityResource
     */
    public function show (int $activityId): ActivityResource
    {
        return new ActivityResource(Activity::find($activityId));
    }
}
