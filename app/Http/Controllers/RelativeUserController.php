<?php

namespace App\Http\Controllers;

use App\Http\Requests\RelativeUserRequest;
use App\Models\RelativeUser;
use Illuminate\Http\Request;

class RelativeUserController extends Controller
{
    public function index(Request $request)
    {
        $countPerPage = (int) $request->count;
        $totalCount = RelativeUser::all()->count();
        $allUsers = RelativeUser::simplePaginate($countPerPage);

        return [
            'items' => $allUsers,
            'totalCount' => $totalCount,
        ];
    }
}
