<?php

use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [JobVacancyController::class, 'getAllVacancies'])->name('all-vacancies');
Route::get('/vacancy/{vacancy_id}', [JobVacancyController::class, 'showVacancy'])->name('vacancy');

Route::get('/users', [UserController::class, 'getAllUsers'])->name('all-users');
Route::get('/users/{user_id}', [UserController::class, 'getUser'])->name('user');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/create-vacancy', [JobVacancyController::class, 'createVacancy'])->name('create-vacancy');
    Route::post('/create-vacancy', [JobVacancyController::class, 'storeVacancy'])->name('store-vacancy');
    Route::get('/edit-vacancy/{vacancy_id}', [JobVacancyController::class, 'editVacancy'])->name('edit-vacancy');
    Route::put('/edit-vacancy', [JobVacancyController::class, 'updateVacancy'])->name('update-vacancy');
    Route::get('/delete-vacancy/{vacancy_id}', [JobVacancyController::class, 'deleteVacancy'])->name('delete-vacancy');

    Route::get('/response/{vacancy_id}', [ResponseController::class, 'sendResponse'])->name('send-response');
    Route::get('/delete-response/{response_id}', [ResponseController::class, 'deleteResponse'])->name('delete-response');
});
