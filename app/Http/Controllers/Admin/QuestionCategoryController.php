<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;

class QuestionCategoryController extends Controller
{
    public function index()
    {
        $questionCategory = QuestionCategory::all();

        return response()->json([$questionCategory]);
    }

    public function create(Request $request)
    {
        $questionCategory = QuestionCategory::create([
            'name' => 'category 5'
        ]);

        return response()->json([$questionCategory]);
    }
}
