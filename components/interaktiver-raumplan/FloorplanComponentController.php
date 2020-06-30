<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;

class FloorplanComponentController extends Controller
{

    private $viewPath = 'components/interaktiver-raumplan/views';
    private $errViewPath = 'components/interaktiver-raumplan/views/error';
    private $svgPath = '/components/public/bi-floorplan/svg';

    private function configViewPath()
    {
        config([
            'view.paths' => [
                realpath(base_path($this->viewPath)),
                realpath(base_path($this->errViewPath))
                ]
        ]);
    }

    public function __construct()
    {
        $this->configViewPath();
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
    public function serveStylesheet()
    {
        $this->configViewPath();

        $css_content = View::make('interaktiver-raumplan-view');

        return (new Response($css_content, '200'))
                  ->header('Content-Type', 'text/css');

    }

    public function getJson($locationId = 0)
    {
        $rooms = null;
        if ($locationId == 0)
            $rooms = app('db')->select("select * from rooms");
        else
            $rooms = app('db')->select("select * from rooms where location_id = ?", [$locationId]);
        return response()->json($rooms);
    }

    public function getFloorplanSVG(string $floorId)
    {
        $svgUrl = url('/') . $this->svgPath;
        $filename = sprintf("$svgUrl/%s.svg", $floorId);
        try {
            $svgString = file_get_contents($filename);
            header('Access-Control-Allow-Origin: *');
            return $svgString;
        } catch (Exception $e) {
            $json = [
                "Fehler" => "Floorplan mit ID=$floorId nicht gefunden"
            ];
            return $this->jsonResponse($json);
        }
    }

    public function getAllLocations()
    {
        $locations = app('db')->select('SELECT * FROM locations');
        return $this->jsonResponse($locations);
    }

    public function getFloorsByLocationId($locationId)
    {
        $floors = app('db')->select('SELECT * FROM floors WHERE location_id=?', [$locationId]);
        return $this->jsonResponse($floors);
    }


    public function getAllRoomDataByFloorId($floorId)
    {
        $sqlString = 'SELECT * FROM rooms WHERE floor_id = ?';
        $rooms = app('db')->select($sqlString, [$floorId]);
        return $this->jsonResponse($rooms);
    }

    public function getRoomDataBySVGId($svgId)
    {
        $sqlString = 'SELECT * FROM rooms WHERE svg_unique_name = ? LIMIT 1';
        $room = app('db')->select($sqlString, [$svgId]);
        return $this->jsonResponse($room);
    }

    public function getPersonsByRoomId($roomId)
    {
        $sqlString = 'SELECT * FROM persons WHERE room_id = ?';
        $room = app('db')->select($sqlString, [$roomId]);
        return $this->jsonResponse($room);
    }

    public function getRoomPersonDataBySVGId($svgId)
    {
        $sqlString = '
            SELECT rooms.function AS room_function,
            rooms.name AS room_name,
            rooms.id AS room_id,
            rooms.description AS room_description,
            rooms.nickname AS room_nickname,
            persons.id AS person_id,
            persons.firstname AS person_firstname,
            persons.lastname AS person_lastname,
            persons.function AS person_function,
            persons.phone AS person_phone
                FROM rooms
                    RIGHT JOIN persons
                    ON rooms.id = persons.room_id
                WHERE svg_unique_name = ?';

        $room = app('db')->select($sqlString, [$svgId]);

        return $this->jsonResponse($room);
    }

}
