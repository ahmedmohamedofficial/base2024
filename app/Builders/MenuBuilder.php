<?php

namespace App\Builders;

class MenuBuilder
{
    private $menu = [];

    /**
     * Add a new item to the menu.
     *
     * @param string $name The name of the menu item.
     * @param int $count The count of the menu item.
     * @param string $icon The icon of the menu item.
     * @param string $route The route of the menu item.
     *
     * @return $this
     */
    public function addMenuItem($name, $count, $icon, $route = null)
    {
        try {
            // Add the new menu item to the menu array
            $this->menu[] = [
                'name'  => __($name),  // Translate the name
                'count' => $count,
                'icon'  => $icon,
                'url'   => $route ? route("admin.$route") : null,  // Generate the URL based on the route
            ];
        } catch (\Exception $e) {
            // Log any exceptions
            error_log($e);
        }

        return $this;  // Return the current object for method chaining
    }

    /**
     * Get the menu.
     *
     * @return mixed The menu data.
     */
    public function getMenu()
    {
        return $this->menu;
    }
}