<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index()
    {
        return view('admin/question/index');
    }

    public function create()
    {
        return view('admin/question/create');
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'question' => 'required|string|max:255',
        //     'answer' => 'required|string|max:255',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        return response()->json([
            'success' => true,
            'message' => 'Question created successfully',
            'data' => $request->all()
        ]);
    }

    public function edit(Question $question)
    {
        return view('admin/question/edit', compact('question'));
    }

    public function update(Request $request, Question $question)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        return response()->json([
            'success' => true,
            'message' => 'Question updated successfully',
            'data' => $request->all()
        ]);
    }

    public function destroy(Question $question)
    {
        return response()->json([
            'success' => true,
            'message' => 'Question deleted successfully',
            'data' => $question
        ]);
    }
}
