<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete'
        ];

        $permissions_client = [
            'role-list',
            'product-list',
            'user-list'
        ];

        $permissions_admin = [
            'role-list',
            'role-create',
            'role-edit',
            'product-list',
            'product-create',
            'product-edit',
            'user-list',
            'user-create',
            'user-edit'
        ];

        $roleSuperAdmin = Role::create(['name' => 'Super Admin']);
        foreach ($permissions as $permission) {
            $permission = Permission::create(['name' => $permission]);
            $roleSuperAdmin->permissions()->save($permission);
        }
        $roleAdmin = Role::create(['name' => 'Admin']);
        foreach ($permissions_admin as $permission_admin) {
            $permission = Permission::where('name', $permission_admin)->first();
            $roleAdmin->permissions()->save($permission);
        }
        $roleClient = Role::create(['name' => 'Client']);
        foreach ($permissions_client as $permission_client) {
            $permission = Permission::where('name', $permission_client)->first();
            $roleClient->permissions()->save($permission);
        }

    }
}
