<?php

use App\Http\Controllers;

$router->get('/floor/show', 'InteraktiverRaumplanServiceController@getView');

$router->get('/floor/json[/{location}]', 'InteraktiverRaumplanServiceController@getJson');