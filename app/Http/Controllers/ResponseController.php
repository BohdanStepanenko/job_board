<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\JobVacancy;
use App\Models\Response;
use App\Mail\ResponseEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiter;

class ResponseController extends Controller
{
    public function getAllResponses()
    {
        return view('pages.responses', ['responses' => Response::orderBy('updated_at', 'desc')->paginate(5)]);
    }

    public function sendResponse(RateLimiter $limiter, int $vacancy_id)
    {
        $coins = Coin::where('user_id', '=', Auth::user()->id)->first();
        $vacancy = JobVacancy::find($vacancy_id);

        if ($coins >= config('pricing.coins.response_price')) {

            // Define sender
            $sender = User::find(Auth::user()->id);

            // Create a key to identify the rate limiter for the user.
            $key = $sender->id . '|' . $vacancy_id . ':send_response';

            // Check if the user has made too many Responses.
            if ($limiter->tooManyAttempts($key, 1)) {
                $availableAt = now()->addSeconds($limiter->availableIn($key))->ago();

                return redirect()->route('vacancy', $vacancy->id)->withErrors( 'Try again '. $availableAt);
            }

            // Prepare email data
            $objDemo = new \stdClass();
            $objDemo->sender = $sender->name;
            $objDemo->title = $vacancy->title;
            $objDemo->date = date_format(now(),"d-m-Y");
            $objDemo->receiver = $vacancy->user->name;
            $objDemo->responses_count = count($vacancy->responses);

            Mail::to($vacancy->user->email)->send(new ResponseEmail($objDemo));

            $limiter->hit($key, 60 * 60);

            Response::create([
                'user_id' => Auth::user()->id,
                'job_vacancy_id' => $vacancy_id,
            ]);

            Coin::find($coins->id)->update([
                'count' => $coins->count - config('pricing.coins.response_price'),
            ]);
        }

        return redirect()->route('vacancy', $vacancy_id);
    }

    public function deleteResponse(int $response_id)
    {
        Response::find($response_id)->delete();

        return redirect()->route('user', Auth::user()->id);
    }
}
