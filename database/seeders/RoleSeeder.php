<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Khwi l-cache dyal Spatie
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Khelqe les 3 rôles
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'gerant', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'client', 'guard_name' => 'web']);

        // 3. Khelqe l-Admin
        $admin = User::firstOrCreate(
            ['email' => env('ADMIN_EMAIL')],
            [
                'name' => 'Reservy Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD')),
            ]
        );

        // 4. Assigni rôle direct
        $admin->syncRoles(['admin']);
    }
}
