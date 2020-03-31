<?php

namespace App\Http\Controllers;

class InteraktiverRaumplanServiceController extends Controller 
{


    /**
     * @muh
    */
    
    public function index () {}

    public function getView() {
        $rooms = app('db')->select('select * from rooms');
        return view('test', ['rooms' => $rooms]);
    }

    public function getJson($locationId) {

        $rooms = app('db')->select("select * from rooms where location_id = ?", [$locationId]);
        return response()->json($rooms);
    }

}