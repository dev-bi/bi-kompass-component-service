<?php
/**
 * API Routes: Interaktiver Raumplan (Floorplan)
 */
$router->group(['prefix' => 'api/floorplan'], function () use ($router) {

    /* Bilden der Floor-ID: Nagelsweg 10 OG 1 -> nw10og1*/
    $router->get('/svg/{floorid}', 'FloorplanComponentController@getFloorplanSVG');
    /* Bilden der Room-ID: Nagelsweg 10 OG 1 R-110 -> nw10-og1-r-110 */
    $router->get('/room/{roomSvgId}', 'FloorplanComponentController@getRoomDataBySVGId');
    /* zu dem Raum gehörende Personen/Mitarbeiter */
    $router->get('/room/{roomId}/persons', 'FloorplanComponentController@getPersonsByRoomId');

    $router->get('/rooms/{floorId}', 'FloorplanComponentController@getAllRoomDataByFloorId');

    $router->get('/floors/{locationid}', 'FloorplanComponentController@getFloorsByLocationId');
    // $router->get('/floors');

    $router->get('/locations', 'FloorplanComponentController@getAllLocations');
    // $router->get('/persons');
});

