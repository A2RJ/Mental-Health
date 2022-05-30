<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionTranslation;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index($question)
    {
        $questions = QuestionCategory::with('questions')->where('id', $question)->first();
        $locales = $this->allLocales();
        return view('admin.question.index', compact('questions', 'locales'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer_options' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

            $question = new Question();
            $question->category_id = $request->category_id;
            $question->save();

            $question->translateOrNew($request->locale)->code = $request->locale;
            $question->translateOrNew($request->locale)->question = $request->question;
            $question->translateOrNew($request->locale)->answer_options = json_encode($request->answer_options);
            $question->save();

            return redirect()->route('question.index', $request->category_id)->with('success', "Question $request->locale has been added");

    }

    public function edit(Question $question)
    {
        return view('admin.question.edit', compact('question'));
    }

    public function update(Request $request, QuestionTranslation $question)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer_options' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $question->question = $request->question;
        $question->answer_options = json_encode($request->answer_options);
        $question->save();

        return redirect()->route('question.index', $request->category_id)->with('success', "Question $question->locale has been updated");
    }

    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->back()->with('success', 'Question has been deleted');
    }
}
