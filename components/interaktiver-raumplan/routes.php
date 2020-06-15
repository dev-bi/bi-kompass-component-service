<?php
/**
 * API Routes: Interaktiver Raumplan (Floorplan)
 */
$router->group(['prefix' => 'api/floorplan'], function () use ($router) {

    /* Bilden der Floor-ID: Nagelsweg 10 OG 1 -> nw10og1*/
    $router->get('/svg/{floorid}', 'FloorplanComponentController@getFloorplanSVG');
    /* Bilden der Room-ID: Nagelsweg 10 OG 1 R-110 -> nw10og1_r-110 */
    $router->get('/room/{roomid}', 'FloorplanComponentController@getRoomdata');

    $router->get('/floors/{locationid}', 'FloorplanComponentController@getFloorsByLocationId');
    // $router->get('/floors');

    $router->get('/locations', 'FloorplanComponentController@getAllLocations');
    // $router->get('/persons');
});

