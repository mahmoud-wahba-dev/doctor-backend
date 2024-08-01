<?php

namespace App\Http\Controllers\Api\Doctor\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\Account\UpdateAccountRequest;
use App\Http\Resources\DOctor\DoctorResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function show()
    {
        return DoctorResource::make(
            Auth::user()->load('account')
        )->additional([
            'status' => Response::HTTP_OK
        ]);
    }

    public function update(
        UpdateAccountRequest $request,
    )
    {

    }
}
