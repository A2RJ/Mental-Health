<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\RumahSakit;

class LocationController extends Controller
{
    public function index()
    {
        $provinces = DB::table('provinces')->select([
                'prov_id as id',
                DB::raw("CONCAT(countries.country_name,' - ',provinces.prov_name) as name"),
            ])
            ->join('countries', 'countries.country_id', '=', 'provinces.country_id')
            ->orderBy('countries.country_name', 'asc')
            ->get();

        return view('admin.location.index')->with([
            'provinces' => $provinces,
        ]);
    }

    public function json(Request $request)
    {
        $response = (object) [];
        $response->draw = @$request["draw"];
        $response->recordsTotal = 0;
        $response->recordsFiltered = 0;
        $response->data = array();

        $query = DB::table('location_rs')
            ->select([
                'location_rs.*',
                'provinces.prov_name',
            ])
            ->join('provinces', 'provinces.prov_id' ,'=', 'location_rs.province_id');

        $keyword = @$request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where(function($q) use ($keyword){
                $q->where("location_rs.rumah_sakit_id", "like", "%".$keyword."%")
                    ->orWhere("location_rs.description_id", "like", "%".$keyword."%")
                    ->orWhere("location_rs.rumah_sakit_en", "like", "%".$keyword."%")
                    ->orWhere("location_rs.description_en", "like", "%".$keyword."%")
                    ->orWhere("location_rs.rumah_sakit_cn", "like", "%".$keyword."%")
                    ->orWhere("location_rs.description_cn", "like", "%".$keyword."%")
                    ->orWhere("provinces.prov_name", "like", "%".$keyword."%");
            });
        }

        $response->recordsTotal = $query->get()->count();
        $response->recordsFiltered = $query->get()->count();
        foreach(@$request["order"] as $i=>$order){
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

        $data = Db::table('location_rs')->where('rs_id', @$request['token'])->first();
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
            'rumah_sakit_id' => 'required|string',
            'description_id' => 'required|string',
            'rumah_sakit_en' => 'required|string',
            'description_en' => 'required|string',
            'rumah_sakit_cn' => 'required|string',
            'description_cn' => 'required|string',
            'provinsi' => 'required|numeric',
        ];

        $element_attributes = [
            'rumah_sakit_id' => '"Rumah Sakit Indonesia"',
            'description_id' => '"Description Indonesia"',
            'rumah_sakit_en' => '"Rumah Sakit English"',
            'description_en' => '"Description English"',
            'rumah_sakit_cn' => '"Rumah Sakit China"',
            'description_cn' => '"Description China"',
            'provinsi' => '"Provinsi"',
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
                $RumahSakit = new RumahSakit();
            } else {
                $RumahSakit = RumahSakit::find(@$request['token']);
            }
            $RumahSakit->rumah_sakit_id = $request['rumah_sakit_id'];
            $RumahSakit->description_id = $request['description_id'];
            $RumahSakit->rumah_sakit_en = $request['rumah_sakit_en'];
            $RumahSakit->description_en = $request['description_en'];
            $RumahSakit->rumah_sakit_cn = $request['rumah_sakit_cn'];
            $RumahSakit->description_cn = $request['description_cn'];
            $RumahSakit->province_id = @$request['provinsi'];
            $RumahSakit->website = @$request['website'];
            $RumahSakit->save();
            
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

    public function delete(Request $request)
    {
        $response = (object) [];
        $response->result = true;
        $response->msg = "Sukse";

        $RumahSakit = RumahSakit::find(@$request['token']);
        if ($RumahSakit) {
            $RumahSakit->forceDelete();
            return response()->json($response, 200);
        } else {
            $response->result = false;
            $response->msg = "Token is not valid";
            return \Response::json($response, 400);
        }
    }
}
