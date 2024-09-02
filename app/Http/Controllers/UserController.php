<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    //
    public function show(string $id)
    {

        $user = User::findOrFail($id);
        return response()->json($user, 200);
    }

    public function showAll()
    {
        // $projects = Project::all();
        $users = User::all();
        return response()->json($users, 200);
    }
}
