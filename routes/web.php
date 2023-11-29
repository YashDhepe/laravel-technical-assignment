<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('content.index');
// });

/************************ Business Settings Management *************************/
Route::controller(SiteController::class)->name('site.')->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('terms-and-conditions', 'terms_and_conditions')->name('terms-and-conditions');
    Route::get('choose-game', 'choose_game')->name('choose-game');
    Route::get('sector/{gameId}', 'sector')->name('sector');
    Route::get('details-form/{sectorId}', 'details_form')->name('details-form');

    Route::post('quiz','quiz_form')->name('quiz');
    Route::get('get-quiz-questions','get_quiz_questions')->name('get-quiz-questions');
    Route::post('submit-quiz','submit_quiz')->name('submit-quiz');
    Route::get('result','result')->name('result');
    // Route::post('store', 'store')->name('store');
    // Route::post('razorpay-x-balance', 'razorpay_x_balance')->name('razorpay-x-balance');
});
/************************ Business Settings Management *************************/

