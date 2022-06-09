<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\QuestionTranslation;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index($question)
    {
        $questions = Question::getQuestions($question);
        $locales = $this->allLocales();
        return view('admin.question.index', compact('question', 'questions', 'locales'));
    }


    public function create($question)
    {
        $locales = $this->allLocales();
        return view('admin.question.create', compact('locales', 'question'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->data, [
            '*.question' => 'required|string|max:255',
            '*.locale' => 'required|string|max:255',
            // '*.answer_a' => 'required|string|max:255',
            // '*.answer_b' => 'required|string|max:255',
            // '*.answer_c' => 'required|string|max:255',
            // '*.answer_d' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $question = new Question();
        $question->category_id = $request->category_id;
        $question->save();

        foreach ($request->data as $data) {
            $question->translateOrNew($data['locale'])->code = $data['locale'];
            $question->translateOrNew($data['locale'])->question = $data['question'];
            $question->translateOrNew($data['locale'])->answer_options = json_encode([
                'a' => 0,
                'b' => 1,
                'c' => 2,
                'd' => 3
            ]);
        }
        $question->save();
        return response()->json([$question], 200);
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
