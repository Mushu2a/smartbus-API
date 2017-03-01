<?php

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

$app->get('/', function () use ($app) {
	return view('index');
});

$app->group(['prefix' => 'user/create', 'namespace' => 'App\Http\Controllers'], function($app) {

	// ex : {"lastname":"Lastennet", "firstname":"Loic", "email":"lastennt.l@gmail.com", "username":"mushu2a", "password":"1234"}
	// http://smart.bus/user/create -> Créer un nouvel utilisateur
	$app->post('/', 'UserController@create');

});

/*
* Utilisateur
 */
$app->group(['prefix' => 'user', 'middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {

	// http://smart.bus/user -> Visualiser l'utilisateur
	$app->get('/', 'UserController@index');
	// http://smart.bus/user/10 -> Visualiser l'utilisateur en rapport à son ID
	$app->get('{id}', 'UserController@find');
	
	// http://smart.bus/user/update -> Modifier l'utilisateur
	$app->put('/update', 'UserController@update');
	$app->put('/', 'UserController@update');
	// Modifier le mot de passe
	$app->put('/update/password', 'UserController@updatePass');
	// http://smart.bus/user/delete -> Supprime l'utilisateur
	$app->delete('/delete', 'UserController@delete');
	$app->delete('/', 'UserController@delete');

});

// http://smart.bus/users/name -> Visualiser ttous les utilisateurs avec nom|prénom|pseudo
$app->get('users/name', 'UserController@allName');

$app->group(['prefix' => 'users', 'middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {

	// http://smart.bus/users -> Visualiser tous les utilisateurs
	$app->get('/', 'UserController@all');

});

/*
* Trajets
 */
$app->group(['prefix' => 'paths', 'middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {

	// http://smart.bus/paths -> Visualiser tous les trajets
	$app->get('/', 'PathController@index');
	// http://smart.bus/paths/10 -> Visualiser le trajet en rapport à son ID
	$app->get('/{id}', 'PathController@find');

	// http://smart.bus/paths/add/10 -> Réserve un trajet
	$app->post('/add/{id}', 'PathController@add');

	// http://smart.bus/paths/search -> Visualiser trajets par rapport à la recherhce
	$app->post('/search', 'PathController@search');

	// http://smart.bus/paths/create -> Ajoute un trajet
	$app->post('/create', 'PathController@create');
	$app->post('/', 'PathController@update');
	// http://smart.bus/paths/update -> Modifier le trajet
	$app->put('/update', 'PathController@update');
	$app->put('/', 'PathController@update');
	// http://smart.bus/paths/delete -> Supprime le trajet
	$app->delete('/delete', 'PathController@delete');
	$app->delete('/', 'PathController@delete');

});

/*
* Réservations
 */
$app->group(['prefix' => 'bookings', 'middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {

	// http://smart.bus/paths -> Visualiser mes réservations
	$app->get('/', 'BookingController@index');

});

/*
* Scores
 */
$app->group(['prefix' => 'scores', 'namespace' => 'App\Http\Controllers'], function($app) {

	// http://smart.bus/score -> Visualiser les scores des utilisateurs
	$app->get('/', 'ScoreController@index');

	$app->post('/', 'ScoreController@updateOrCreate');
	$app->put('/', 'ScoreController@updateOrCreate');

});

/*
* Localisation
 */

// http://smart.bus/localise-> Visualiser toute les localisation par date d'aujourd'hui
$app->get('localise', 'LocationController@allDate');

$app->group(['prefix' => 'localisation', 'middleware' => 'auth', 'namespace' => 'App\Http\Controllers'], function($app) {

	$app->post('/', 'LocationController@create');
	$app->put('/', 'LocationController@update');

});
