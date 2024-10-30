<?php

namespace App\Http\Controllers\Api\V1\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Min\UserRegisterRequest;
use App\Http\Resources\Api\V1\Main\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        $qrCode = QrCode::generate($user->id);
        $user->qr_code = $qrCode;
        $user->save();
        $token = $user->createToken('api_token')->plainTextToken;
        $data = [
            'user' => new UserResource($user),
            'token' => $token
        ];
        return $this->apiSuccess($data);
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->apiSuccess(message: 'Logged out successfully');
    }
}