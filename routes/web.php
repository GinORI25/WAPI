<?php

use App\Livewire\BroadcastForm;
use App\Livewire\Buy;
use App\Livewire\ProjectDash;
use App\Models\prodashpost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/message', function () {
    return view('msg');
});

Route::get('/dashboard', function () {
    return view('index');
});

Route::get('/buy', function () {
    return view('buy');
});

Route::get('/broadcast', function () {
    return view('bc');
});

Route::get('/draft', function () {
    return view('draft');
});

Route::get('/package', function () {
    return view('package');
});

Route::get('/notification', function () {
    return view('notif');
});

Route::get('/setting', function () {
    return view('settings');
});

Route::get('/logout', function () {
    return view('logout');
});


Route::get('/customorder', function () {
    return view('cusorder');
});

Route::get('/custompay', function () {
    return view('cuspay ');
});

Route::get('/customexp', function () {
    return view('usex ');
});

Route::get('/cususer', function () {
    return view('cususer ');
});

Route::get('/project-dash', ProjectDash::class)->name('posts');

Route::get('/broadcast-form/{id?}', BroadcastForm::class)->name('broadcast-form');

Route::get('/buy/{id}', Buy::class)->name('buy');
