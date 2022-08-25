<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllUsers()
    {
        return view('pages.users', ['users' => User::paginate(5)]);
    }

    public function getUser(int $user_id)
    {
        $user = User::find($user_id);

        return view('pages.single_user', ['user' => $user]);
    }
}
