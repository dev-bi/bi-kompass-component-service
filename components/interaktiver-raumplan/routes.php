<?php
$router->group(['prefix' => 'api/floorplan'], function () use ($router) {

    $router->get('/svg/{floorid}', 'FloorplanComponentController@getFloorplanSVG');
    $router->get('/room/{roomid}', 'FloorplanComponentController@getRoomdata');

    // $router->get('/floor/{locationid}');
    // $router->get('/floors');

    $router->get('/locations', 'FloorplanComponentController@getAllLocations');
    // $router->get('/persons');

    $router->get('/blubb', function () {
        dd('blubb');
    });
});

// $router->get('/floor-component/view/show', 'InteraktiverRaumplanServiceController@show');
// $router->get('/floor-component/view/css', 'InteraktiverRaumplanServiceController@serveStylesheet');
// $router->get('/floor-component/json[/{location}]', 'InteraktiverRaumplanServiceController@getJson');
