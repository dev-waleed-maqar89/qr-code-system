<?php

namespace App\Http\Controllers\Api\V1\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Min\UserRegisterRequest;
use App\Http\Resources\Api\V1\Main\UserResource;
use App\Http\Traits\ApiResponseTrait;
use App\Mail\Main\UserRegisterMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserAuthController extends Controller
{
    use ApiResponseTrait;

    public function register(UserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'parent_email' => $request->parent_email,
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
        Mail::to($request->email)->send(new UserRegisterMail($user));
        return $this->apiSuccess(data: $data, message: 'User registered successfully');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (!auth()->attempt($credentials)) {
            return $this->apiError(message: 'Invalid credentials', code: 401);
        }
        $user = User::where('email', $request->email)->first();
        $token = $user->createToken('api_token')->plainTextToken;
        $data = [
            'user' => new UserResource($user),
            'token' => $token
        ];
        return $this->apiSuccess(data: $data, message: 'Logged in successfully');
    }
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->apiSuccess(message: 'Logged out successfully');
    }
}