<?php

use App\Http\Controllers\Api\Doctor\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'as' => 'api.'
],function (){
    Route::group([
        'as' => 'doctor.',
        'prefix' => 'doctor'
    ],function (){
        Route::group([
            'as' => 'auth.',
            'prefix' => 'auth'
        ], function (){
            Route::post('login', [AuthController::class, 'login'])->name('login');
        });
    });
});
