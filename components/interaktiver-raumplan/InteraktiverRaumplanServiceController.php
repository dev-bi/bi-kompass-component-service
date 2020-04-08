<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

class InteraktiverRaumplanServiceController extends Controller 
{

    private $viewPath = 'components/interaktiver-raumplan/views';
      
    private function configViewPath () {
        config([
            'view.paths' => [realpath(base_path($this->viewPath))]
        ]);
    }

    /**
     * Zeigt die Komponente an.
     * 
     * In Wordpress wird diese Methode aufgerufen, um die Komponente einzubinden
     *  
     * @return View Gibt View der Komponente als HTML zurück.
     */
    public function show() {
        $this->configViewPath();

        $rooms = app('db')->select('select * from rooms');
        return view('test', ['rooms' => $rooms]);
    }





    /**
     * Wird verwendet, um die css Datei der Komponente in Wordpress einzubinden.
     * 
     * @return Response gibt die für diesen View verwendete css datei zurück.
     */
    public function serveStylesheet() {
        $this->configViewPath();

        $css_content = View::make('interaktiver-raumplan-view');

        return (new Response($css_content, '200'))
                  ->header('Content-Type', 'text/css');

    }





    public function getJson($locationId = 0) {
        $rooms = null;
        if ($locationId == 0)
            $rooms = app('db')->select("select * from rooms");
        else
            $rooms = app('db')->select("select * from rooms where location_id = ?", [$locationId]);
        return response()->json($rooms);
    }

}