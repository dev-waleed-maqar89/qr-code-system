<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{id}/mail', function ($id) {
    $user = User::find($id);
    return view('Mails.Main.UserRegisterMail', compact('user'));
});