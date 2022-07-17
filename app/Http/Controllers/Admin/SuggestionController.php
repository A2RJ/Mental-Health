<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Suggestion;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function json()
    {
        $suggestions = Suggestion::all();
        return response()->json($suggestions);
    }

    public function index()
    {
        if (request()->has('locale')) {
            $suggestions = Suggestion::where('locale', request('locale'))->get();
        } else {
            $suggestions = Suggestion::all();
        }

        return view('admin.suggestions.index', compact('suggestions'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'locale' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $suggestion = Suggestion::create([
            'locale' => $request->locale,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Suggestion created successfully');
    }

    public function update(Request $request, Suggestion $suggestion)
    {
        $this->validate($request, [
            'locale' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);

        $suggestion->update([
            'locale' => $request->locale,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('suggestions.index');
    }
    public function destroy(Suggestion $suggestion)
    {
        $suggestion->delete();
        return redirect()->back()->with('success', 'Suggestion deleted successfully');
    }

    public function insertSuggestion()
    {
        $idSuggestion = Suggestion::idSuggestion();
        $enSuggestion = Suggestion::enSuggestion();
        $cnSuggestion = Suggestion::cnSuggestion();

        foreach ($idSuggestion as $key => $value) {
            Suggestion::create([
                'locale' => 'id',
                'title' => $value['title'],
                'description' => $value['description'],
            ]);
        }
        foreach ($enSuggestion as $key => $value) {
            Suggestion::create([
                'locale' => 'en',
                'title' => $value['title'],
                'description' => $value['description'],
            ]);
        }
        foreach ($cnSuggestion as $key => $value) {
            Suggestion::create([
                'locale' => 'cn',
                'title' => $value['title'],
                'description' => $value['description'],
            ]);
        }

        return redirect()->back()->with('success', 'Suggestion inserted successfully');
    }

    public function drop()
    {
        Suggestion::truncate();
        return redirect()->back()->with('success', 'Suggestion dropped successfully');
    }
}
