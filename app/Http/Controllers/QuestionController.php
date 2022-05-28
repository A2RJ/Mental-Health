<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;

class QuestionController extends Controller
{
    public function index()
    {
        $question = Question::getQuestions('id', 1);

        return response()->json([$question]);
    }

    public function create()
    {
        return view('question.create');
    }

    public function store(Request $request)
    {
        $question = Question::create([
            'category_id' => 4,
        ]);

        foreach (['id', 'en', 'cn'] as $locale) {
            $question->translateOrNew($locale)->question = "question $locale";
            $question->translateOrNew($locale)->answer_options = json_encode(["option 1 for $locale", "option 2 for $locale", "option 3 for $locale", "option 4 for $locale"]);
        }

        $question->save();
        return response()->json([$question]);
    }
}
