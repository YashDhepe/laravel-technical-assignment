<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\AppUserQuizResponse;
use App\Models\AppUserQuizResponseDetail;
use App\Models\Game;
use App\Models\QuizMessage;
use App\Models\QuizQuestion;
use App\Models\Sector;
use App\Models\VoucherCriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SiteController extends Controller
{
    public function home()
    {
        // --- Flush Session --- //
        Session::flush();

        // --- Page Config --- //
        $pageConfigs = ['title' => 'Home'];
        return view('content.home', compact('pageConfigs'));
    }

    public function terms_and_conditions()
    {
        // --- Page Config --- //
        $pageConfigs = ['title' => 'Terms & Conditions'];
        return view('content.terms-and-conditions', compact('pageConfigs'));
    }

    public function choose_game()
    {
        // --- Reset Game & Sector Id from Session --- //
        Session::forget('game_id');
        Session::forget('sector_id');

        // --- Page Config --- //
        $pageConfigs = [
            'title' => 'Choose Game',
            'navbar_config' => [
                'type' => 'back_btn_navbar',
                'title' => 'Choose Your Game',
                'backbtn_url' => route('site.home'),
            ]
        ];

        // --- Fetch Games --- //
        $games = Game::all();

        return view('content.choose-game', compact('pageConfigs', 'games'));
    }

    public function sector($gameId)
    {
        // --- Set Game Id in Session --- //
        session(['game_id' => $gameId]);

        // --- Page Config --- //
        $pageConfigs = [
            'title' => 'Sector',
            'navbar_config' => [
                'type' => 'back_btn_navbar',
                'title' => 'Sector',
                'backbtn_url' => route('site.choose-game'),
            ]
        ];

        // --- Fetch Sectors as Per Game --- //
        $game = Game::with('sectors')->find(decrypt($gameId));
        $sectors = $game->sectors;

        return view('content.sector', compact('pageConfigs', 'sectors'));
    }

    public function details_form($sectorId)
    {
        // --- Set Sector Id in Session --- //
        session(['sector_id' => $sectorId]);

        // --- Page Config --- //
        $pageConfigs = [
            'title' => 'Fill Your Details',
            'navbar_config' => [
                'type' => 'back_btn_navbar',
                'title' => 'Fill Your Details',
                'backbtn_url' => route('site.sector', ['gameId' => session('game_id')]),
            ]
        ];

        return view('content.details-form', compact('pageConfigs'));
    }

    public function quiz_form(Request $request)
    {

        // --- Validation --- //
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phoneNum' => 'required|numeric|digits:10',
            'terms_and_conditions' => 'required'
        ]);

        $appUser = AppUser::where([
            ['email', $request->email],
            ['mobile', $request->phoneNum]
        ])->first();

        if (!is_null($appUser)) {
            $sectorQuizAttempts = AppUserQuizResponse::where([
                ['app_user_id', $appUser->id],
                ['game_id', decrypt(session('game_id'))],
                ['sector_id', decrypt(session('sector_id'))],
            ])->count();

            if ($sectorQuizAttempts > 0) {
                return redirect()->route('site.details-form', ['sectorId' => (session('sector_id'))])->withErrors(['sector_quiz_attemp' => 'Youhave already attempted quiz in this Sector!.']);
            }
        }

        // --- Set User Info in Session --- //
        Session::put([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_mobile' => $request->phoneNum,
            'user_terms_and_conditions' => $request->terms_and_conditions,
            'user_whatsapp_update' => $request->whatsapp_update,
        ]);

        // --- Page Config --- //
        $pageConfigs = [
            'title' => 'Quiz',
            'navbar_config' => [
                'type' => 'back_btn_navbar',
                'title' => 'Quiz',
                'backbtn_url' => route('site.home'),
            ]
        ];

        $quizQuestions = QuizQuestion::with(['options'])->get();
        return view('content.quiz', compact('pageConfigs', 'quizQuestions'));
    }

    public function get_quiz_questions()
    {
        $quizQuestions = QuizQuestion::with(['options'])->inRandomOrder()->get();
        echo json_encode($quizQuestions);
    }

    public function submit_quiz(Request $request)
    {

        $appUser = AppUser::create([
            'name' => session('user_name'),
            'email' => session('user_email'),
            'mobile' => session('user_mobile'),
        ]);
        session(['app_user_id' => encrypt($appUser->id)]);

        // --- Fetch Game --- //
        $game = Game::find(decrypt(session('game_id')));

        // --- Store Quiz Response based on Game Type  --- //
        if ($game->type == "career_assessment") {
            // GAME1
            $voucherCriteria = VoucherCriteria::where([
                ['score_start', '<=', $request->user_score],
                ['score_end', '>=', $request->user_score],
            ])->first();

            $appUserQuizResponse = AppUserQuizResponse::create([
                'app_user_id' => $appUser->id,
                'game_id' => decrypt(session('game_id')),
                'sector_id' => decrypt(session('sector_id')),
                'terms_and_conditions' => (session('user_terms_and_conditions') == 'on') ? '1' : '0',
                'whatsapp_update' => (session('user_whatsapp_update') == 'on') ? '1' : '0',
                'score' => $request->user_score,
                'voucher' => strtoupper(Str::random(8)),
                'amount' => $voucherCriteria->amount ?? 0,
            ]);
        } elseif ($game->type == "job_market_assesment") {
            // GAME2 
            $voucherCriteria = QuizMessage::where([
                ['score_start', '<=', $request->user_score],
                ['score_end', '>=', $request->user_score],
            ])->first();

            $appUserQuizResponse = AppUserQuizResponse::create([
                'app_user_id' => $appUser->id,
                'game_id' => decrypt(session('game_id')),
                'sector_id' => decrypt(session('sector_id')),
                'terms_and_conditions' => (session('user_terms_and_conditions') == 'on') ? '1' : '0',
                'whatsapp_update' => (session('user_whatsapp_update') == 'on') ? '1' : '0',
                'score' => $request->user_score,
                'message' => $voucherCriteria->message ?? 'NA',
            ]);
        }

        // --- Store Quiz Response Details  --- //
        $appUserQuizResponseDetails = [];
        foreach ($request->user_mcq_response as $key => $quiz_question) {
            if (!empty($quiz_question)) {
                $appUserQuizResponseDetails[$key]['app_user_quiz_response_id'] = $appUserQuizResponse->id;
                $appUserQuizResponseDetails[$key]['quiz_question_id'] = $quiz_question['question_id'];
                $appUserQuizResponseDetails[$key]['selected_option'] = isset($quiz_question['selected_option']) ? $quiz_question['selected_option'] : null;
                $appUserQuizResponseDetails[$key]['created_at'] = now();
                $appUserQuizResponseDetails[$key]['updated_at'] = now();
            }
        }
        AppUserQuizResponseDetail::insert($appUserQuizResponseDetails);

        echo json_encode([
            'status' => 'success',
            'redirection_url' => route('site.result')
        ]);
    }

    public function result(Request $request)
    {
        // --- Page Config --- //
        $pageConfigs = [
            'title' => 'Quiz',
            'navbar_config' => [
                'type' => 'empty_navbar',
            ]
        ];

        $quizResponse = AppUserQuizResponse::with(['app_user', 'quiz_details', 'game'])->where([
            ['game_id', decrypt(session('game_id'))],
            ['sector_id', decrypt(session('sector_id'))],
            ['app_user_id', decrypt(session('app_user_id'))],
        ])->first();
        return view('content.result', compact('pageConfigs', 'quizResponse'));
    }
}
