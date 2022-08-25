<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use App\Models\JobVacancy;
use App\Http\Requests\CreateVacancyRequest;
use App\Http\Requests\UpdateVacancyRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Cache\RateLimiter;

class JobVacancyController extends Controller
{
    public function getAllVacancies()
    {
        $vacancies = JobVacancy::orderBy('updated_at', 'desc')->with('responses')->get()->sortByDesc(function($vacancies)
        {
            return $vacancies->responses->count();
        });

        return view('pages.vacancies', ['vacancies' => $vacancies]);
    }

   public function showVacancy(int $vacancy_id)
   {
       $vacancy = JobVacancy::find($vacancy_id);

       return view('pages.single_vacancy', ['vacancy' => $vacancy]);
   }

    public function createVacancy()
    {
        return view('pages.create_vacancy');
    }

    public function storeVacancy(CreateVacancyRequest $request, RateLimiter $limiter)
    {
        $coins = Coin::where('user_id', '=', Auth::user()->id)->first();

        if ($coins->count >= config('pricing.coins.post_price'))
        {
            // Create a key to identify the rate limiter for the user.
            $key = Auth::user()->id . ':post_vacancy';

            // Check if the user post more than 2 vacancies.
            if ($limiter->tooManyAttempts($key, config('pricing.coins.post_per_day'))) {
                $availableAt = now()->addSeconds($limiter->availableIn($key))->ago();

                return redirect()->route('create-vacancy')->withErrors( 'You`ve already post' . config('pricing.coins.post_per_day') . 'vacancies today. Try again '. $availableAt);
            }

            JobVacancy::create([
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'description' => $request->description
            ]);

            Coin::find($coins->id)->update([
                'count' => $coins->count - config('pricing.coins.post_price'),
            ]);

            return redirect()->route('all-vacancies');
        }

        return redirect()->route('create-vacancy')->withErrors( 'Insufficient funds');
    }

    public function editVacancy(int $vacancy_id)
    {
        $vacancy = JobVacancy::find($vacancy_id);

        return view('pages.edit_vacancy', ['vacancy' => $vacancy]);
    }

    public function updateVacancy(UpdateVacancyRequest $request)
    {
        JobVacancy::find($request->vacancy_id)->update($request->validated());

        return redirect()->route('user', Auth::user()->id);
    }

    public function deleteVacancy(int $vacancy_id)
    {
        JobVacancy::find($vacancy_id)->delete();

        return redirect()->route('user', Auth::user()->id);
    }
}
