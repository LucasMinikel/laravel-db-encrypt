<?php

use App\Models\User;
use App\Services\Crypter;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = User::find(1);
    $users = User::whereCpf('12345678900')->get();
    dd($user?->cpf, $users);
    return view('welcome');
});
