<?php
$router->get('/hello', 'SearchServiceController@index');

$router->get('/find[/{sstring}]', 'SearchServiceController@find');