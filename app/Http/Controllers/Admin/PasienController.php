<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Country;
use App\Models\Pasiens;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class PasienController extends Controller
{
    public function index()
    {
        $keyword = request('keyword');
        $pasiens = DB::table('pasiens')
            ->join("question_category", "question_category.id", "=", "pasiens.category")
            ->join('countries', 'pasiens.country', 'countries.country_id')
            ->join('provinces', 'pasiens.location', 'provinces.prov_id')
            ->select([
                'pasiens.*',
                'question_category.name as category',
                'countries.country_name as country',
                'provinces.prov_name as location'
            ])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('pasiens.name', 'LIKE', "%$keyword%")
                    ->orWhere('pasiens.occupation', 'LIKE', "%$keyword%")
                    ->orWhere('pasiens.score', 'LIKE', "%$keyword%")
                    ->orWhere('pasiens.result', 'LIKE', "%$keyword%")
                    ->orWhere('question_category.name', 'LIKE', "%$keyword%")
                    ->orWhere('countries.country_name', 'LIKE', "%$keyword%")
                    ->orWhere('provinces.prov_name', 'LIKE', "%$keyword%");
            })
            ->paginate();

        return view('admin.pasiens.index')
            ->with('pasiens', $pasiens);
    }

    public function json(Request $request)
    {
        $response = (object) [];
        $response->draw = @$request["draw"];
        $response->recordsTotal = 0;
        $response->recordsFiltered = 0;
        $response->data = array();

        $query = DB::table('pasiens')
            ->join("question_category", "question_category.id", "=", "pasiens.category")
            ->select([
                'pasiens.*',
                'question_category.name as category'
            ]);

        $keyword = @$request["keyword"];
        if ($keyword <> "") {
            $query = $query->where(function ($q) use ($keyword) {
                $q->where("pasiens.name", "like", "%" . $keyword . "%")
                    ->orWhere("pasiens.category", "like", "%" . $keyword . "%")
                    ->orWhere("pasiens.location", "like", "%" . $keyword . "%")
                    ->orWhere("pasiens.occupation", "like", "%" . $keyword . "%")
                    ->orWhere("pasiens.result", "like", "%" . $keyword . "%");
            });
        }

        $response->recordsTotal = $query->get()->count();
        $response->recordsFiltered = $query->get()->count();
        foreach (@$request["order"] as $i => $order) {
            $query = $query->orderBy($order["column"], $order["dir"]);
        }
        $response->data = $query->skip(@$request["start"])->take(@$request["length"])->get()->toArray();

        return \Response::json($response, 200);
    }

    public function show(Request $request)
    {
        $response = (object) [];
        $response->result = true;
        $response->msg = "";
        $response->data = null;

        $data = Db::table('pasiens')->where('pasien_id', @$request['token'])->first();
        if ($data) {
            $data->testing = unserialize($data->test);
            $response->data = $data;
            return response()->json($response, 200);
        } else {
            $response->result = false;
            $response->msg = "Token is not valid";
            return \Response::json($response, 400);
        }
    }

    public function destroy(Pasiens $pasiens)
    {
        $pasiens->delete();
        return redirect()->route('pasiens.index');
    }

    public function export()
    {
        $pasiens = Pasiens::join("question_category", "question_category.id", "=", "pasiens.category")
            ->join('countries', 'pasiens.country', 'countries.country_id')
            ->join('provinces', 'pasiens.location', 'provinces.prov_id')
            ->select([
                'pasiens.*',
                'question_category.name as category',
                'countries.country_name as country',
                'provinces.prov_name as location'
            ])
            ->get();

        $pasiens = $pasiens->map(function ($item) {
            $item['lang'] = $item && $item->test ? json_decode($item->test)->locale : '';
            return $item;
        });
        return (new FastExcel($pasiens))->download('file.xlsx');
    }
}
