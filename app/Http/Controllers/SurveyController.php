<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

class SurveyController extends Controller
{
    public $lang;

    public function __construct(Request $request)
    {
        $this->lang = $request->query('select-locale') ? $request->query('select-locale') : 'en';
        App::setLocale($this->lang);
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

    public function start($category)
    {
        return view('survey')
            ->with([
                'country' => $this->country($this->lang),
                'category' => $category,
                'questions' => Question::getQuestions($category),
                'records' => Question::getRules(),
            ]);
    }

    public function store(Request $request)
    {
        $total = 0;
        $result = Lang::get('welcome.result.normal');
        $profile = $request->biodata;
        $rujukan = false;
        $category = $request->category;

        foreach ($request->all() as $key => $answer) {
            $total += intval($answer);
        }

        switch ($category) {
            case 'depression':
                if ($total >= 10 && $total <= 13) {
                    $result = Lang::get('welcome.result.mild');
                    $rujukan = true;
                }
                if ($total >= 14 && $total <= 20) {
                    $result = Lang::get('welcome.result.moderate');
                    $rujukan = true;
                }
                if ($total >= 21 && $total <= 27) {
                    $result = Lang::get('welcome.result.severe');
                    $rujukan = true;
                }
                if ($total >= 28) {
                    $result = Lang::get('welcome.result.extreme');
                    $rujukan = true;
                }
                break;

            case 'stress':
                if ($total >= 8 && $total <= 9) {
                    $result = Lang::get('welcome.result.mild');
                    $rujukan = true;
                }
                if ($total >= 10 && $total <= 14) {
                    $result = Lang::get('welcome.result.moderate');
                    $rujukan = true;
                }
                if ($total >= 15 && $total <= 19) {
                    $result = Lang::get('welcome.result.severe');
                    $rujukan = true;
                }
                if ($total >= 20) {
                    $result = Lang::get('welcome.result.extreme');
                    $rujukan = true;
                }
                break;

            case 'anxiety':
                if ($total >= 15 && $total <= 18) {
                    $result = Lang::get('welcome.result.mild');
                    $rujukan = true;
                }
                if ($total >= 19 && $total <= 25) {
                    $result = Lang::get('welcome.result.moderate');
                    $rujukan = true;
                }
                if ($total >= 26 && $total <= 33) {
                    $result = Lang::get('welcome.result.severe');
                    $rujukan = true;
                }
                if ($total >= 34) {
                    $result = Lang::get('welcome.result.extreme');
                    $rujukan = true;
                }
                break;

            default:
                // code...
                break;
        }

        if ($rujukan) {
            $rujukan = DB::table('location_rs')
                ->select([
                    'location_rs.*',
                    'provinces.prov_name',
                ])
                ->join('provinces', 'provinces.prov_id', '=', 'location_rs.province_id')
                ->where('provinces.prov_name', $profile['location'])
                ->orderBy('location_rs.rumah_sakit_id')
                ->get();
        }

        return [
            'total' => $total,
            'category' => $category,
            'result' => $result,
            'rujukan' => $rujukan,
            'profile' => $profile,
        ];
    }
}
