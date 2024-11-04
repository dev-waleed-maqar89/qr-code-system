<?php

namespace App\Http\Controllers\APi\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\Main\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $users = UserResource::collection(User::paginate(12));
        return $this->apiSuccess(compact('users'));
    }
    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->apiError(message: 'User not found', code: 404);
        }
        $user = new UserResource($user);
        return $this->apiSuccess(compact('user'));
    }
}