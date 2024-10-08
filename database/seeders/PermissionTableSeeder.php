<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [];
        foreach (config('permissions') as $route) {
            if (isset($route['as'])) {
                $permissions[] = ['role_id' => 1, 'permission' => 'admin.' . $route['as']];
            }
            foreach ($route['child'] ?? [] as $key => $child) {
                $permissionName = is_int($key) ? $route['child'][$key] : $key;
                $permissions[]  = ['role_id' => 1, 'permission' => 'admin.' . $permissionName];
            }
        }

        Permission::insert($permissions);
    }
}
