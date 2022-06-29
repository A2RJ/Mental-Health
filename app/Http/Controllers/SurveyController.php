<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Pasiens;
use App\Models\Province;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;

use function PHPSTORM_META\map;

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
        $name = request()->input('name');
        $age = request()->input('age');
        $occupation = request()->input('occupation');
        $location = request()->input('location');

        return view('survey')
            ->with([
                'country' => $this->country($this->lang),
                'category' => $category,
                'questions' => Question::getQuestions($category),
                'records' => Question::getRules(),
                'biodata' => [
                    'name' => $name,
                    'age' => $age,
                    'occupation' => $occupation,
                    'location' => $location,
                    'category' => $category,
                ]
            ]);
    }

    public function store(Request $request)
    {
        $total = 0;
        $result = Lang::get('welcome.result.normal');
        $rujukan = false;
        $category = QuestionCategory::find($request->category);

        $answerList = $request->except('_token', 'name', 'age', 'occupation', 'location', 'category');
        foreach ($answerList as $key => $answer) {
            $total += intval($answer);
        }

        switch ($category->category_name) {
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

        $country = Province::where('prov_id', $request->location)->first();

        $pasiens = Pasiens::create([
            'name' => $request->name,
            'age' => $request->age,
            'occupation' => $request->occupation,
            'country' => $country->country_id,
            'location' => $request->location,
            'category' => $request->category,
            'test' => json_encode($answerList),
            'score' => $total,
            'result' => $result,
        ]);

        return redirect("/result/$pasiens->pasien_id");
    }

    public function result($id)
    {

        $pasiens = Pasiens::find($id);
        if (!$pasiens) {
            return redirect('/');
        }
        $category = QuestionCategory::find($pasiens->category);
        $total = $pasiens->score;
        $rujukan = false;
        switch ($category->name) {
            case 'depression':
                if ($total >= 10 && $total <= 13) {
                    $rujukan = true;
                }
                if ($total >= 14 && $total <= 20) {
                    $rujukan = true;
                }
                if ($total >= 21 && $total <= 27) {
                    $rujukan = true;
                }
                if ($total >= 28) {
                    $rujukan = true;
                }
                break;

            case 'stress':
                if ($total >= 8 && $total <= 9) {
                    $rujukan = true;
                }
                if ($total >= 10 && $total <= 14) {
                    $rujukan = true;
                }
                if ($total >= 15 && $total <= 19) {
                    $rujukan = true;
                }
                if ($total >= 20) {
                    $rujukan = true;
                }
                break;

            case 'anxiety':
                if ($total >= 15 && $total <= 18) {
                    $rujukan = true;
                }
                if ($total >= 19 && $total <= 25) {
                    $rujukan = true;
                }
                if ($total >= 26 && $total <= 33) {
                    $rujukan = true;
                }
                if ($total >= 34) {
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
                    "location_rs.rumah_sakit_$this->lang as rumah_sakit",
                    "location_rs.description_$this->lang as description",
                    'provinces.prov_name',
                ])
                ->join('provinces', 'provinces.prov_id', '=', 'location_rs.province_id')
                ->where('provinces.prov_id', $pasiens->location)
                ->orderBy('location_rs.rumah_sakit_id')
                ->get();
        }

        return view('result')
            ->with([
                'total' => $pasiens->score,
                'category' => $pasiens->category,
                'result' => $pasiens->result,
                'rujukan' => $rujukan,
                'profile' => $pasiens,
                'location' => Province::where('prov_id', $pasiens->location)->first()->prov_name,
                'suggestion' => Question::suggestion(),
            ]);
    }
}
