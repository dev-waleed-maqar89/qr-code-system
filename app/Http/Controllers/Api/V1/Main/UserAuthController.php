<?php

namespace App\Http\Controllers\Api\V1\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Min\UserRegisterRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    use ApiResponseTrait;

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('api_token')->plainTextToken;
        $data = [
            'user' => $user,
            'token' => $token
        ];
        return $this->apiSuccess($data);
    }
}
