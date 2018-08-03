<?php

namespace App\Providers;
use App\Genre;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */


    public function boot(Request $request)
    {

            view()->composer(['partials.menu', 'partials.sidebar'], function($view) use($request){
                $zoneAdmin = false;

                if($request->user()) {
                    switch ($request->user()->elevation) {
                        case "admin":
                            $zoneAdmin = true;
                            break;
                    }
                }
                $view->with([
                    'zoneAdmin' => $zoneAdmin,
                    'titleAdmin' => 'Bienvenu dans l\'administration des ressources',
                    'genres' => Genre::pluck('name', 'id')->all(),
                ]);
            });
            /*view()->composer(['partials.note'], function($view) use($request) {
                $notes = DB::select('select note,book_id,user_id from ratings');
                $view->with([
                    'notes' => $notes
                ]);*/

    /*});*/
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

}
