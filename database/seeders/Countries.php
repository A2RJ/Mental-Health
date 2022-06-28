<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Countries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            'INDONESIA',
            'MALAYSIA',
            'CHINA',
        ];
        DB::beginTransaction();
        try {
            foreach ($countries as $key => $country) {
                DB::table('countries')->insert([
                    'country_name' => $country,
                ]);
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }
}
