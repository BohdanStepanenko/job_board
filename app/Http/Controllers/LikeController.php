<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\Like;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function getLiked()
    {
        $liked_users = Like::where('user_id', Auth::user()->id)
            ->where('liked_type', 'App\Models\User')
            ->get();

        $liked_vacancies = Like::where('user_id', Auth::user()->id)
            ->where('liked_type', '=', 'App\Models\JobVacancy')
            ->get();

//        foreach($liked_users as $user)
//            dd($user->liked);


        return view('pages.favorite', ['liked_users' => $liked_users, 'liked_vacancies' => $liked_vacancies]);
    }

    public function setLike(Request $request)
    {
        Like::create([
            'user_id' => Auth::user()->id,
            'liked_type' => $request->liked_type,
            'liked_id' => $request->liked_id
        ]);

        return redirect()->back();
    }

    public function deleteLike(string $liked_type, int $liked_id)
    {
        Like::where('liked_type', '=', $liked_type)->find($liked_id)->delete();

        return redirect()->back();
    }
}
