<?php

namespace Database\Seeders;

use App\Helper\Permission\Permission as HelperPermission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');
        $permissions = new HelperPermission();

        foreach ($permissions->get_permissions() as $key => $permission) {
            $super_admin_permissions[$key] = [
                'create',
                'read',
                'update',
                'delete'
            ];
        }

        $super_admin = Role::create(['name' => 'Süper Admin']);

        foreach ($permissions->get_permissions() as $key => $permission) {
            $create = Permission::create([
                'name' => 'create ' . $key
            ]);
            if (@in_array('create', $super_admin_permissions[$key])) {
                $super_admin->givePermissionTo($create);
            }
            $read = Permission::create([
                'name' => 'read ' . $key
            ]);
            if (@in_array('read', $super_admin_permissions[$key])) {
                $super_admin->givePermissionTo($read);
            }
            $update = Permission::create([
                'name' => 'update ' . $key
            ]);
            if (@in_array('update', $super_admin_permissions[$key])) {
                $super_admin->givePermissionTo($update);
            }
            $delete = Permission::create([
                'name' => 'delete ' . $key
            ]);
            if (@in_array('delete', $super_admin_permissions[$key])) {
                $super_admin->givePermissionTo($delete);
            }
        }
    }
}
