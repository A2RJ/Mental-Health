<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Provinces extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
            [
                "prov_name" => "Jawa Timur",
                "country_id" => 1,
            ],
            [
                'prov_name' => 'ACEH',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SUMATERA UTARA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SUMATERA BARAT',
                'country_id' => 1
            ],
            [
                'prov_name' => 'RIAU',
                'country_id' => 1
            ],
            [
                'prov_name' => 'JAMBI',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SUMATERA SELATAN',
                'country_id' => 1
            ],
            [
                'prov_name' => 'BENGKULU',
                'country_id' => 1
            ],
            [
                'prov_name' => 'LAMPUNG',
                'country_id' => 1
            ],
            [
                'prov_name' => 'KEPULAUAN BANGKA BELITUNG',
                'country_id' => 1
            ],
            [
                'prov_name' => 'KEPULAUAN RIAU',
                'country_id' => 1
            ],
            [
                'prov_name' => 'DKI JAKARTA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'JAWA BARAT',
                'country_id' => 1
            ],
            [
                'prov_name' => 'JAWA TENGAH',
                'country_id' => 1
            ],
            [
                'prov_name' => 'DI YOGYAKARTA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'JAWA TIMUR',
                'country_id' => 1
            ],
            [
                'prov_name' => 'BANTEN',
                'country_id' => 1
            ],
            [
                'prov_name' => 'BALI',
                'country_id' => 1
            ],
            [
                'prov_name' => 'NUSA TENGGARA BARAT',
                'country_id' => 1
            ],
            [
                'prov_name' => 'NUSA TENGGARA TIMUR',
                'country_id' => 1
            ],
            [
                'prov_name' => 'KALIMANTAN BARAT',
                'country_id' => 1
            ],
            [
                'prov_name' => 'KALIMANTAN TENGAH',
                'country_id' => 1
            ],
            [
                'prov_name' => 'KALIMANTAN SELATAN',
                'country_id' => 1
            ],
            [
                'prov_name' => 'KALIMANTAN TIMUR',
                'country_id' => 1
            ],
            [
                'prov_name' => 'KALIMANTAN UTARA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SULAWESI UTARA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SULAWESI TENGAH',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SULAWESI SELATAN',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SULAWESI TENGGARA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'GORONTALO',
                'country_id' => 1
            ],
            [
                'prov_name' => 'SULAWESI BARAT',
                'country_id' => 1
            ],
            [
                'prov_name' => 'MALUKU',
                'country_id' => 1
            ],
            [
                'prov_name' => 'MALUKU UTARA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'PAPUA',
                'country_id' => 1
            ],
            [
                'prov_name' => 'PAPUA BARAT',
                'country_id' => 1
            ],
            [
                'prov_name' => 'WUHAN',
                'country_id' => 1
            ],
        ];
        DB::beginTransaction();
        try {
            foreach ($provinces as $key => $province) {
                DB::table('provinces')->insert([
                    'prov_name' => $province['prov_name'],
                    'country_id' => $province['country_id'],
                ]);
            }
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }
}
