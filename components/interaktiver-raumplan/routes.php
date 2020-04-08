<?php

$router->get('/floor-component/view/show', 'InteraktiverRaumplanServiceController@show');
$router->get('/floor-component/view/css', 'InteraktiverRaumplanServiceController@serveStylesheet');

$router->get('/floor-component/json[/{location}]', 'InteraktiverRaumplanServiceController@getJson');