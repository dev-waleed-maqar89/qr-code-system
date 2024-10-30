<?php

namespace App\Http\Controllers\Api\V1\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Dashboard\AdminRegisterRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Admin;
use Illuminate\Http\Request;

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
            'admin' => $admin,
            'token' => $token
        ];
        return $this->apiSuccess($data);
    }
}