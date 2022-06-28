<?php

namespace Database\Seeders;

use Illuminate\Database\QueryException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'stress',
            'depression',
            'anxiety',
        ];
        DB::beginTransaction();
        try {
            foreach ($categories as $category) {
                DB::table('question_category')->insert([
                    'name' => $category,
                ]);
            }
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }
}
