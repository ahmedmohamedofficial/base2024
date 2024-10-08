<?php 

namespace App\Services\Command\DashboardCrud;

use Illuminate\Support\Facades\Artisan;


class PermissionService
{

    /**
     * Create routes for a given folder and model.
     *
     * @param string $folderName The name of the folder.
     * @param string $model      The name of the model.
    */
    function createPermission($folderName, $model)
    {
        // Get the contents of the web.php file
        $webContents = file_get_contents('config/permissions.php');

        // Define the new routes
        $newRoutes = "/*------------ start Of $folderName ----------*/
		'$folderName'     => [
		'as'        => '$folderName.index',
		'title'     => '$folderName.index',
		'icon'      => '<i class=\"menu-icon fa fa-headset\"></i>',
		'sub_route' => true,
		'sub_link' => true,
		'child'     => [
			'$folderName.index' => ['sub_link' => true,],
			'$folderName.create'=>['sub_link' => true,],
			'$folderName.store',
			'$folderName.show',
			'$folderName.edit',
			'$folderName.update',
			'$folderName.delete',
			'$folderName.deleteAll',
		]
	],

    /*------------ end Of $folderName ----------*/

    #new_permissions_here";

        // Replace the placeholder in the web.php file with the new routes
        $newWebContents = preg_replace("/#new_permissions_here/", $newRoutes, $webContents);

        // Write the updated contents back to the web.php file
        file_put_contents('config/permissions.php', $newWebContents);

        // Clear the route cache
        Artisan::call('config:clear');
    }
}
