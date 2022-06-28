<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionCategoryController extends Controller
{
    public function index()
    {
        $questions = QuestionCategory::all();
        $locales = $this->allLocales();
        return view('admin.question-category.index', compact('questions', 'locales'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $name = strtolower($request->name);
        QuestionCategory::create([
            'name' => $name,
        ]);

        return redirect()->route('question-category.index')->with('success', 'Question category created successfully');
    }

    public function update(Request $request, QuestionCategory $questionCategory)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $questionCategory->update($request->only('name'));

        return redirect()->route('question-category.index')->with('success', 'Question category updated successfully');
    }

    public function destroy(QuestionCategory $questionCategory)
    {
        $questionCategory->delete();

        return redirect()->route('question-category.index')->with('success', 'Question category deleted successfully');
    }
}
