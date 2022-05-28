<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use DB;
use App\Models\Country;

class PasienController extends Controller
{
    public function index()
    {
        return view('admin.pasiens.index')->with([
            
        ]);
    }

    public function json(Request $request)
    {
        $response = (object) [];
        $response->draw = @$request["draw"];
        $response->recordsTotal = 0;
        $response->recordsFiltered = 0;
        $response->data = array();

        $query = DB::table('pasiens')
            ->select([
                'pasiens.*',
            ]);

        $keyword = @$request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where(function($q) use ($keyword){
                $q->where("pasiens.name", "like", "%".$keyword."%")
                	->orWhere("pasiens.category", "like", "%".$keyword."%")
                	->orWhere("pasiens.location", "like", "%".$keyword."%")
                	->orWhere("pasiens.occupation", "like", "%".$keyword."%")
                	->orWhere("pasiens.result", "like", "%".$keyword."%");
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
}
