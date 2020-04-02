<?php
$router->get('/hello', 'SearchServiceController@index');

$router->get('/search-component/find[/{sstring}]', 'SearchServiceController@find');
$router->get('/search-component/view/css', 'SearchServiceController@serve_css');
$router->get('/search-component/view/show', 'SearchServiceController@show');