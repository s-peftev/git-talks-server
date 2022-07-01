<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelativeUserRequest;
use App\Models\RelativeUser;
use Illuminate\Http\Request;

class RelativeUserController extends Controller
{
    public function index(Request $request)
    {
        $countPerPage = min((int)$request->count, 50);
        $totalCount = RelativeUser::all()->count();
        $allUsers = RelativeUser::simplePaginate($countPerPage);

        return [
            'items' => $allUsers,
            'totalCount' => $totalCount,
        ];
    }
}
