<?php

namespace App\Traits;

use Illuminate\Support\Facades\Route;
use App\Models\Permission;

trait  SideBarTrait
{

    /**
     * Render the sidebar view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    static function sidebar()
    {
        // Get the permissions for the current admin user
        $my_routes = Permission::where('role_id', auth()->guard('admin')->user()->role_id)
            ->pluck('permission')
            ->toArray();

        // Determine the routes data based on the user type
        $routes_data = auth('admin')->check() && auth('admin')->user()->type == 'super_admin'
            ? self::superAdminRoutes()
            : self::authAdminRoutes($my_routes);

//dd($routes_data);
        // Return the sidebar view with the necessary data
        return view('admin.shared.sidebar.sidebar', compact('my_routes', 'routes_data'));
    }

    /**
     * Filter and retrieve data from admin routes.
     *
     * @param array $my_routes The routes to be filtered.
     * @param array $routes The routes to be compared against.
     * @return array The filtered routes data.
     */
    static function authAdminRoutes($my_routes)
    {
        $filteredRoutes = array_filter(config('permissions'), function ($route) use ($my_routes) {
            return isset($route['as']) && in_array('admin.' . $route['as'], $my_routes) && isset($route['title']);
        });

        return self::extractRoutesData($filteredRoutes);
    }

    /**
     * Extracts super admin routes data.
     *
     * @param array $routes The array of routes.
     *
     * @return array The extracted super admin routes data.
     */
    static function superAdminRoutes()
    {
        $filteredRoutes = array_filter(config('permissions'), function ($route) {
            return isset($route['title']);
        });

        return self::extractRoutesData($filteredRoutes);
    }

    /**
     * Extracts routes data based on the given criteria.
     *
     * @param array $routes The array of routes to extract data from.
     *
     * @return array The extracted routes data.
     */
    private static function extractRoutesData($routes)
    {
        $routes_data = [];

        foreach ($routes as $route) {
            $childRoutes = $route['child'] ?? [];

            $routes_data[$route['title']] = [
                'routeName' => $route['as'] ?? "",
                'sub_link'  => $route['sub_link'] ?? false,
                'child'     => count($childRoutes) ? $childRoutes : false,
                'sub_route' => $route['sub_route'] ?? false,
                'type'      => $route['type'] ?? null,
                'title'     => $route['title'],
                'icon'      => $route['icon'] ?? null,
                'name'      => 'admin.' . $route['title'],
                'count'     => count(array_filter(array_keys($childRoutes) ?? [], 'is_string')),
            ];
        }

        return $routes_data;
    }
}
