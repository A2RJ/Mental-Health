<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class GiveRoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        // create roles and assign created permissions
        try {
            $users = User::all();
            foreach ($users as $key => $user) {
                $user->syncRoles('Super Admin');
            }

            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }
}
