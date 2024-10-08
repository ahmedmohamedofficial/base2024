<?php 

namespace App\Services\Command\DashboardCrud;

use Illuminate\Support\Facades\Artisan;


class RouteService
{

    /**
     * Create routes for a given folder and model.
     *
     * @param string $folderName The name of the folder.
     * @param string $model      The name of the model.
    */
    function createRoute($folderName, $model)
    {
        // Get the contents of the web.php file
        $webContents = file_get_contents('routes/web.php');
        $Controller = $model.'Controller';

        // Define the new routes
        $newRoutes = "/*------------ start Of $folderName ----------*/
		Route::group(['prefix' => '$folderName', 'as' => '$folderName.'], function () {
			Route::get('/', [$Controller::class, 'index'])->name('index');
			Route::get('/create', [$Controller::class, 'create'])->name('create');
			Route::post('/store', [$Controller::class, 'store'])->name('store');
			Route::get('/{id}/edit', [$Controller::class, 'edit'])->name('edit');
			Route::put('/{id}', [$Controller::class, 'update'])->name('update');
			Route::get('/{id}/Show', [$Controller::class, 'show'])->name('show');
			Route::delete('/{id}', [$Controller::class, 'destroy'])->name('delete');
			Route::post('delete-all', [$Controller::class, 'destroyAll'])->name('deleteAll');
			Route::get('export', [$Controller::class, 'export'])->name('export');
		});

    /*------------ end Of $folderName ----------*/

    #new_routes_here";

        // Replace the placeholder in the web.php file with the new routes
        $newWebContents = preg_replace("/#new_routes_here/", $newRoutes, $webContents);

        // Write the updated contents back to the web.php file
        file_put_contents('routes/web.php', $newWebContents);

        // Clear the route cache
        Artisan::call('route:clear');
    }
}
