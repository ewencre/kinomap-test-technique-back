<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserActivityResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    /**
     * @return AnonymousResourceCollection
     */
    public function index (): AnonymousResourceCollection
    {
        return UserResource::collection(User::paginate(5));
    }
    
    /**
     * @param int $userId
     * 
     * @return UserResource
     */
    public function show (int $userId): UserResource
    {
        return new UserResource(User::find($userId));
    }

    /**
     * @param int $userId
     * @param int $activityId
     * 
     * @return mixed
     */
    public function activities (int $userId, int $activityId)
    {
        $activities = UserActivity::all()
            ->where('user_id', '=', $userId)
            ->where('activity_id', '=', $activityId);

        $userActivities = UserActivityResource::collection($activities);

        $averageSpeed = $activities->avg('speed');

        return new Collection(['user_activities' => $userActivities, 'average_speed' => $averageSpeed]);
    }
}
