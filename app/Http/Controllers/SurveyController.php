<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->query('select-locale') ?? 'en';
    }

    public function country($country)
    {
        switch ($country) {
            case 'id':
                $country = 'Indonesia';
                break;
            case 'en':
                $country = 'English';
                break;
            case 'cn':
                $country = 'Chinese';
                break;
            default:
                $country = 'Indonesia';
                break;
        }

        return $country;
    }

    public function index()
    {
        $locations = Country::join('provinces', 'provinces.country_id', '=', 'countries.country_id')
            ->select('countries.country_name', 'provinces.prov_id', 'provinces.prov_name')
            ->get();

        $cateogries = QuestionCategory::all();

        return view('index')
            ->with([
                'country' => $this->country($this->lang),
                'locations' => $locations,
                'categories' => $cateogries,
            ]);
    }

    public function question($category)
    {
        return response()->json(Question::getQuestions($category));
    }
}
