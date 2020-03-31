<?php

use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    //return $router->app->version();
    echo "This is the BI-Kompass-Component-Service. Hello World.";
});


/** 
 * Routes 'Suche'
 * 
 */

$router->get('/hello', 'SearchServiceController@index');

$router->get('/find[/{sstring}]', 'SearchServiceController@find');

require_once 'components/interaktiver-raumplan/routes.php';


