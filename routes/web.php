<?php

use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = User::find(1);
    $users = User::where('cpf', Crypt::encrypt('12345678909'))->get();
    dd($user->cpf, $users);
    return view('welcome');
});
