<?php

$router->get('/floor/show', 'InteraktiverRaumplanServiceController@show');
$router->get('/floor/css', 'InteraktiverRaumplanServiceController@serveStylesheet');

$router->get('/floor/json[/{location}]', 'InteraktiverRaumplanServiceController@getJson');