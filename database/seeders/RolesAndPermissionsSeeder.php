<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $Administrator = Role::create(['name' => 'administrator', 'guard_name' => 'web']);
        $Client = Role::create(['name' => 'client', 'guard_name' => 'web']);
    }
}
