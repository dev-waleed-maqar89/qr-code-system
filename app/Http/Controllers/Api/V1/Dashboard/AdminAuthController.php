<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\AdminRegisterRequest;
use App\Http\Resources\Api\V1\Dashboard\AdminResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    use ApiResponseTrait;
    public function register(AdminRegisterRequest $request)
    {

        $admin = Admin::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        $token = $admin->createToken('api_token')->plainTextToken;
        $data = [
            'admin' => new AdminResource($admin),
            'token' => $token
        ];
        return $this->apiSuccess($data);
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('username', 'password');
        if (!Auth::guard('admin')->attempt($credentials)) {
            return $this->apiError(message: 'Invalid credentials', code: 401);
        }
        $admin = Admin::where('username', $request->username)->first();
        $token = $admin->createToken('api_token')->plainTextToken;
        $data = [
            'admin' => new AdminResource($admin),
            'token' => $token
        ];
        return $this->apiSuccess(data: $data, message: 'Logged in successfully');
    }
}