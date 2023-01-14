<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Province;
use Illuminate\Support\Facades\DB;

class ProvinceController extends Controller
{
    public function index()
    {
        $countries = DB::table('countries')
            ->select([
                'country_id as id',
                'country_name as name',
            ])
            ->orderBy('country_name', 'asc')
            ->get();

        $keyword = request('keyword');
        $provinces = Province::with('country')
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('country', function ($query) use ($keyword) {
                    $query->where('country_name', 'LIKE', "%$keyword%");
                })->orWhere('prov_name', 'LIKE', "%$keyword%");
            })
            ->paginate();

        return view('admin.provinces.index')->with([
            'countries' => $countries,
            'provinces' => $provinces
        ]);
    }

    public function json(Request $request)
    {
        $response = (object) [];
        $response->draw = @$request["draw"];
        $response->recordsTotal = 0;
        $response->recordsFiltered = 0;
        $response->data = array();

        $query = DB::table('provinces')
            ->select([
                'provinces.*',
                'countries.country_name',
            ])
            ->join('countries', 'countries.country_id', '=', 'provinces.country_id');

        $keyword = @$request["keyword"];
        if ($keyword <> "") {
            $query = $query->where(function ($q) use ($keyword) {
                $q->where("provinces.prov_name", "like", "%" . $keyword . "%")
                    ->orWhere("countries.country_name", "like", "%" . $keyword . "%");
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

        $data = Db::table('provinces')->where('prov_id', @$request['token'])->first();
        if ($data) {
            $response->data = $data;
            return response()->json($response, 200);
        } else {
            $response->result = false;
            $response->msg = "Token is not valid";
            return \Response::json($response, 400);
        }
    }

    public function save(Request $request)
    {
        $response = (object) [];

        $element_checks = [
            'prov_name' => 'required|string',
            'country_id' => 'required|numeric',
        ];

        $element_attributes = [
            'prov_name' => '"Provinsi"',
            'country_id' => '"Negara"',
        ];

        $mode = $request->post("mode");
        if ($mode == "edit") {
            array_merge($element_checks, ['token' => 'required|string']);
            array_merge($element_attributes, ['token' => '"Token"']);
        }

        $validator = Validator::make($request->all(), $element_checks)->setAttributeNames($element_attributes);
        if ($validator->fails()) {
            $res["result"] = false;
            $res["msg"] = $validator->messages()->all();
            return response()->json($res);
        }

        DB::beginTransaction();
        try {
            if ($mode == "add") {
                $Province = new Province();
            } else {
                $Province = Province::find(@$request['token']);
            }
            $Province->prov_name = $request['prov_name'];
            $Province->country_id = $request['country_id'];
            $Province->save();

            $response->result = true;
            $response->msg = "Sukses";
            DB::commit();
        } catch (\QueryException $e) {
            $response->result = false;
            $response->msg = "Gagal";
            DB::rollback();
        }

        return \Response::json($response, 200);
    }

    public function destroy(Province $prov_id)
    {
        $prov_id->delete();
        return redirect()->route('provinces.index');
    }
}
