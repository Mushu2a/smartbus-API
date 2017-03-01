<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SmartBus</title>

		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic&subset=latin,cyrillic">
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="header">
			<div class="contenu">
				<object type="image/svg+xml" data="smartCode.svg">
					Le navigateur ne supporte pas les fichiers SVG !
				</object>
				<p>SmartBus : Bienvenue à vous !<br><br> <a href="#documentation">Documentation &#9749;</a> | <a href="https://gitlab.com/cruptus/smartbus-API" target="_blank">GitLab &#9729;</a> | <a href="https://play.google.com/store/search?q=Smartbus" target="_blank">Android &#9889;</a> | <a href="https://twitter.com/Mushu2a" target="_blank">@Mushu2a &#9917;</a>.
				</p>
			</div>
		</div>

		<div id="documentation">
			<h2>Web API</h2>
			<h3>List API user example</h3>

			<div class="table-responsive-vertical ombre">
				<table id="table" class="table table-hover light-blue">
					<thead>
						<tr>
							<th>Method</th>
							<th>URL</th>
							<th>Controler@method</th>
							<th>Information</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-title="Method">GET</td>
							<td data-title="URL">http://smartbus.esy.es/user</td>
							<td data-title="Controler@method">UserController@index</td>
							<td data-title="Information">User authenticate</td>
						</tr>
						<tr>
							<td data-title="Method">GET</td>
							<td data-title="URL">http://smartbus.esy.es/user/{id}</td>
							<td data-title="Controler@method">UserController@find</td>
							<td data-title="Information">Fetch User by id</td>
						</tr>
						<tr>
							<td data-title="Method">POST</td>
							<td data-title="URL">http://smartbus.esy.es/create</td>
							<td data-title="Controler@method">UserController@create</td>
							<td data-title="Information">Create a new User</td>
						</tr>
						<tr>
							<td data-title="Method">PUT</td>
							<td data-title="URL">http://smartbus.esy.es/  or (update)</td>
							<td data-title="Controler@method">UserController@update</td>
							<td data-title="Information">Update User auth</td>
						</tr>
						<tr>
							<td data-title="Method">DELETE</td>
							<td data-title="URL">http://smartbus.esy.es/  or (delete)</td>
							<td data-title="Controler@method">UserController@delete</td>
							<td data-title="Information">Delete User auth</td>
						</tr>
					</tbody>
				</table>
			</div>

			<a href="#more">See More +</a>

			<p><strong>Send HTTP request (<em>Before create POST</em>).</strong></p>

			<blockquote>
			<p>
				You have to pass Headers with <strong>Content-Type</strong> <em>application/json</em> for valid JSON to API and inside Body
			</p>
			</blockquote>

			<pre><code class="javascript">
{
	"lastname": "Test",
	"firstname": "Test",
	"email": "test@test.com",
	"username": "Test",
	"password": "1234"
}

Ce compte est disponible pour les tests
			</code></pre>

			<hr>

			<p><strong>Send HTTP request (<em>after create POST</em>).</strong></p>

			<blockquote>
			<p>You have to advise API for authentication a <strong>'Token'</strong> or a (<strong>email</strong> OR <strong>username</strong> AND <strong>password</strong>) for start<br>
			<strong>Token</strong> is display on API return such as : <em>'api_token'</em> =&gt; $token<br>
			Now you can do everything you want who are in the list.</p>
			</blockquote>

			<pre><code class="javascript">var ex = "Exemple using PUT Request and what you can update";
{
	'lastname': '',
	'firstname': '',
	'email': '',
	'username': '',
	'phone': '',
	'birthday': '',
	'address1',
	'address2',
	'city',
	'zip': '',
	'country',
	'gender': '',
	'brandBus': '',
	'comfort': '',
	'number': '',
	'owner': '',
	'password': '',
}
			</code></pre>

			<p>
				Ex Headers for login<br>
				<strong>email</strong> <em>lastennet.l@gmail.com</em><br>
				<strong>username</strong> <em>mushu2a</em><br>
				<strong>password</strong> <em>1234</em>
			</p>

			<h3>Errors</h3>

			<p>
				<strong>401</strong> Unauthorized -&gt; <em>You have give wrong 'Token' or email&nbsp;| username &amp;&amp; password</em><br>
				<strong>404</strong> Not Found -&gt; <em>You use wrong URI or use bad URL</em><br>
				<strong>500</strong> Internal Server Error -&gt; <em>You do something wrong ? No it's good, it's not your fault !</em>
			</p>

			<pre><code class="javascript" id="more">
/*
|--------------------------------------------------------------------------
| Application All Routes API
|--------------------------------------------------------------------------
|
*/
	// http://smart.bus/user/create -> Créer un nouvel utilisateur
	$app->post('/user/create', 'UserController@create');

/*
* Utilisateur
* 
* Required => authentificate
 */

	// http://smart.bus/user -> Visualiser l'utilisateur
	$app->get('/user/', 'UserController@index');
	// http://smart.bus/user/10 -> Visualiser l'utilisateur en rapport à son ID
	$app->get('{id}', 'UserController@find');

	// http://smart.bus/user/update -> Modifier l'utilisateur
	$app->put('/user/update', 'UserController@update');
	$app->put('/user', 'UserController@update');

	// http://smart.bus/user/delete -> Supprime l'utilisateur
	$app->delete('/user/delete', 'UserController@delete');
	$app->delete('/user', 'UserController@delete');

	// http://smart.bus/user -> Visualiser tous les utilisateurs
	$app->get('/users', 'UserController@all');

/*
*
* No authentificate
*
 */
	// http://smart.bus/users/name -> Visualiser tous les utilisateurs avec nom|prénom|pseudo
	$app->get('users/name', 'UserController@allName');


/*
* Trajets
*
* Required => authentificate
 */

	Visualiser tous les trajets
	$app->get('/paths', 'PathController@index');

	Visualiser un trajet en rapport à son ID
	$app->get('/paths/{id}', 'PathController@find');

	Créer un trajet
	$app->post('/paths/create', 'PathController@create');
	$app->post('/paths', 'PathController@update');

	Modifier le trajet
	$app->put('/paths/update', 'PathController@update');
	$app->put('/paths', 'PathController@update');

	Supprime le trajet
	$app->delete('/paths/delete', 'PathController@delete');
	$app->delete('/paths', 'PathController@delete');

/*
* Scores
*
* No authentificate
 */

	// http://smart.bus/score -> Visualiser les 5 meilleurs utilisateurs
	$app->get('/scores', 'ScoreController@index');

	$app->post('/scores', 'ScoreController@updateOrCreate');
	$app->put('/scores', 'ScoreController@updateOrCreate');

/*
* Localisation
*
* Required => authentificate
 */

	$app->post('/localisation', 'LocationController@create');
	$app->put('/localisation', 'LocationController@update');

/*
*
* No authentificate
*
 */
	// http://smart.bus/localise-> Visualiser toute les localisation par date d'aujourd'hui
	$app->get('localise', 'LocationController@allDate');
			</code></pre>
		</div>
	</body>
</html>
