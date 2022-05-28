<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Hash;

class CreateAdminSeeder extends Seeder
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
            $adminExist = User::where('email', 'admin@admin.id')->first();
            if ($adminExist) {
                dd('Admin `admin@admin.id` already exist.');
                die;
            }

            $userAdmin = User::create([
                'name' => 'Admin Mental Health',
                'email' => 'admin@admin.id',
                'email_verified_at' => now(),
                'password' => Hash::make('Qwer1234'),
            ]);
            
            $userAdmin->syncRoles('Super Admin');
            
            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }
}
