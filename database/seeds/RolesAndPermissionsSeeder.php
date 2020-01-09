<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        Permission::create(['name' => 'edit-recipe']);
        Permission::create(['name' => 'delete-recipe']);
        Permission::create(['name' => 'publish-recipe']);
        Permission::create(['name' => 'unpublish-recipe']);

        // create roles and assign created permissions
        $role = Role::create(['name' => 'patient']);
        $role = Role::create(['name' => 'nutritionist']);
        $role->givePermissionTo([
            'edit-recipe',
            'delete-recipe',
            'publish-recipe',
            'unpublish-recipe'
        ]);
        $role = Role::create(['name' => 'admin']);
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}
