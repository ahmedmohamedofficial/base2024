<?php

namespace App\Traits;

use App\Models\Permission;

trait AdminFirstRouteTrait {
    public function getAdminFirstRouteName($authRoutes = null) {
        $routeName = 'intro';

        if (auth('admin')->check() && auth('admin')->user()->type == 'super_admin') {
            $routeName = 'admin.dashboard';
        }

        if (!$authRoutes) {
            $authRoutes = Permission::where('role_id', auth()->guard('admin')->user()->role_id) ->pluck('permission')  ->toArray();
        }

        foreach (config('permissions') as $route) {

            if (in_array($route['as'] ?? "", $authRoutes)) {
                $routeName = 'admin.' . $route['as'];
                break;
            }
        }

        return $routeName;
    }
}