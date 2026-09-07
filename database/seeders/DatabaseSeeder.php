<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */



public function run(): void
{
    $adminRole = Role::firstOrCreate([
        'name' => 'admin',
        'guard_name' => 'web',
    ]);

    $admin = User::firstOrCreate(
        ['email' => 'admin@reservy.test'],
        [
            'name' => 'Reservy Admin',
            'password' => Hash::make('ChangeMe123!'),
        ]
    );

    $admin->assignRole($adminRole);
}
}
