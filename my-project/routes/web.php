<?php

use App\Http\Controllers\MyUserControler;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/resume', function () {
//     return view('resume');
// });


Route::view("/", '/home');
Route::view("resume", '/resume');
Route::view("contact", '/contact');
Route::view("dashboard", '/dashboard');
// Route::view("condition", '/condition', ['name'=>"Jubayer"]);

Route::get('/dashboard', function () {
    return redirect("/");
});

Route::get('/condition/{userName}', function ($userName) {
    return view('condition', ['name' => $userName]);
});

Route::get('/user/{userName}', function ($userName) {
    return view('user', ['name' => $userName]);
});

Route::get('controller/{anyparam}', [MyUserControler::class, "loadMyView"]);
