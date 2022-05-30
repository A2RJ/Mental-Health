<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Country;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class CountryController extends Controller
{
    public function index()
    {
        return view('admin.countries.index')->with([

        ]);
    }

    public function json(Request $request)
    {
        $response = (object) [];
        $response->draw = @$request["draw"];
        $response->recordsTotal = 0;
        $response->recordsFiltered = 0;
        $response->data = array();

        $query = DB::table('countries')
            ->select([
                'countries.*',
            ]);

        $keyword = @$request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where(function($q) use ($keyword){
                $q->where("countries.country_name", "like", "%".$keyword."%");
            });
        }

        $response->recordsTotal = $query->get()->count();
        $response->recordsFiltered = $query->get()->count();
        foreach(@$request["order"] as $i=>$order){
            $query = $query->orderBy($order["column"], $order["dir"]);
        }
        $response->data = $query->skip(@$request["start"])->take(@$request["length"])->get()->toArray();

        return Response::json($response, 200);
    }

    public function show(Request $request)
    {
        $response = (object) [];
        $response->result = true;
        $response->msg = "";
        $response->data = null;

        $data = Db::table('countries')->where('country_id', @$request['token'])->first();
        if ($data) {
            $response->data = $data;
            return response()->json($response, 200);
        } else {
            $response->result = false;
            $response->msg = "Token is not valid";
            return Response::json($response, 400);
        }
    }

    public function save(Request $request)
    {
        $response = (object) [];

        $element_checks = [
            'country_name' => 'required|string',
        ];

        $element_attributes = [
            'country_name' => '"Negara"',
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
                $Country = new Country();
            } else {
                $Country = Country::find(@$request['token']);
            }
            $Country->country_name = $request['country_name'];
            $Country->save();

            $response->result = true;
            $response->msg = "Sukses";
            DB::commit();

        } catch (QueryException $e) {
            $response->result = false;
            $response->msg = "Gagal";
            DB::rollback();
        }

        return Response::json($response, 200);
    }
}
