<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\CreateUserResource;
use App\Http\Resources\ShowUserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        try {
            $user = User::create($request->all());
            return response()->json(['id'=> $user->id],201);
        }
       catch (\Exception $e){
           return response()->json([],400);
       }
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user){
            return response()->json([],404);
        }
        return new ShowUserResource($user);
    }
}
