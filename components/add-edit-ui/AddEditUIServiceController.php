<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

/**
 * addEditUIServiceController 
 * 
 * stellt eine Eingabemaske und die entsprechenden Operationen bereit,
 * um Daten in die BI-Kompass Datenbank zu schreiben und zu bearbeiten
 */

class AddEditUIServiceController extends Controller{

    
      
    public function index () {}

    public function show() {
        $path = config('view.paths');
        return "View Paths: " . $path;
//        config(['view.paths']);
        //$rooms = app('db')->select('select * from rooms');
        //return view('add-edit-ui-index-html');
    }

    public function serveStylesheet() {
        $css_content = View::make('add-edit-ui-view');

        return (new Response($css_content, '200'))
                  ->header('Content-Type', 'text/css');

    }
    


}