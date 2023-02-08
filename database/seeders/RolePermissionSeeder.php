<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            'admin' => [
                'access job',
                'destroy job',
                'edit job',
                'store job',
                'update job',
                'create job',
                'show job',

                'access announcement',
                'destroy announcement',
                'edit announcement',
                'store announcement',
                'update announcement',
                'create announcement',
                'show announcement',
            ],
            'employer' => [
                'access job',
                'destroy job',
                'edit job',
                'store job',
                'update job',
                'create job',
                'show job',
            ],
            'alumni' => [
                'apply job',
            ],
        ];

        foreach ($roles as $role => $permissions) {
            $db_role = Role::where('name', $role)->first();
            if (!$db_role) {
                // CREATE NEW ROLE
                $db_role = Role::create(['name' => $role]);
            }
            // ADD PERMISSION
            foreach ($permissions as  $permission) {
                $new_permission = Permission::where('name', $permission)->first();
                if (!$new_permission) {
                    $new_permission = Permission::create([
                        'name' => $permission
                    ]);
                }
                if (!$db_role->hasPermissionTo($permission)) {
                    $db_role->givePermissionTo($permission);
                }
            }
        }
        // ASSIGN admin ROLE
        $user = User::where('email', 'admin@admin.com')->first();
        $user->assignRole('admin');
        $user->approved = 1;
        $user->save();

        // ASSIGN orgadmin ROLE
        $user = User::where('email', 'employer@admin.com')->first();
        $user->assignRole('employer');
        $user->approved = 1;
        $user->save();


        // ASSIGN orgadmin ROLE
        $user = User::where('email', 'alumni@admin.com')->first();
        $user->assignRole('alumni');

        $user->approved = 1;
        $user->save();

    }
}
