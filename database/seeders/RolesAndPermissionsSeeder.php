<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $permissions = [
            'index location',
            'get location',
            'create location',
            'edit location',
            'delete location',
        ];

        DB::beginTransaction();
        // create roles and assign created permissions
        try {
            $userAdmin = Role::create(['name' => 'Super Admin']);
            foreach ($permissions as $key => $permission) {
                Permission::create(['name' => $permission]);
                $userAdmin->givePermissionTo($permission);
            }

            // $userClient = Role::create(['name' => 'Client']);

            DB::commit();
        } catch (QueryException $e) {
            DB::rollback();
            dd($e);
        }
    }
}
