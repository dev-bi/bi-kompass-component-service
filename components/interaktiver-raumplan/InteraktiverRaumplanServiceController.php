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

    public function getJson($locationId = 0) {
        $rooms = null;
        if ($locationId == 0)
            $rooms = app('db')->select("select * from rooms");
        else
            $rooms = app('db')->select("select * from rooms where location_id = ?", [$locationId]);
        return response()->json($rooms);
    }

}