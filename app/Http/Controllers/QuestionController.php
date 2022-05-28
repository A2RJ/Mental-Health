<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {

        $question = Question::find(7);
        // $question->score = 1;
        // $question->save();

        // foreach (['en', 'nl', 'fr', 'de'] as $locale) {
        //     $question->translateOrNew($locale)->question = "Title {$locale}";
        //     $question->translateOrNew($locale)->answer_options = json_encode([
        //         [
        //             'option1' => "question 1",
        //             'score' => 1
        //         ],
        //         [
        //             'option1' => "question 1",
        //             'score' => 1
        //         ],
        //         [
        //             'option1' => "question 1",
        //             'score' => 1
        //         ],
        //         [
        //             'option1' => "question 1",
        //             'score' => 1
        //         ]
        //     ]);
        // }

        // $question->save();
        // $question = Question::find(7);
        app()->setLocale('en');
        return response()->json([$question->question, json_decode($question->answer_options)]);

        // return view('question');
    }

    public function formSubmit(Request $request)
    {
        return $request->all();
    }
}
