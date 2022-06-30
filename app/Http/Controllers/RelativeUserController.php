<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelativeUserRequest;
use App\Models\RelativeUser;

class RelativeUserController extends Controller
{
    public function index()
    {
        return [
            'items' => RelativeUser::all(),
        ];
    }
}
