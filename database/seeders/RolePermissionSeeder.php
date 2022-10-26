<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);

        Permission::create(['name' => 'approve order']);
        Permission::create(['name' => 'cancel order']);

        Permission::create(['name' => 'make order']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        // $role = Role::create(['name' => 'role-manager'])
        //     ->givePermissionTo(['add role', 'update role', 'delete role','make order']);

        $role = Role::create(['name' => 'vendor'])
            ->givePermissionTo(['add product', 'edit product', 'delete product','make order']);

            $role = Role::create(['name' => 'customer'])
            ->givePermissionTo(['add product', 'edit product', 'delete product','make order']);

    }
}
