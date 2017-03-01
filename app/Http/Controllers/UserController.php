<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function index() {
		$auth = Auth::user();
		$user = User::find($auth->id);

		return response()->json($user);
	}

	public function find($id) {
		$user = User::find($id);

		return response()->json($user);
	}

	public function all() {
		$array = array("lastname", "firstname", "email", "username", "phone", "birthday", "address1", "address2", "city", "zip", "country", "gender", "brandBus", "comfort", "number", "owner" ,"created_at");
		$user = User::all($array);

		return response()->json($user);
	}

	public function allName() {
		$array = array("lastname", "firstname", "username");
		$user = User::all($array);

		return response()->json($user);
	}

	public function create(Request $request) {
		$this->validate($request, [
			'email' => 'required|email|unique:users,email',
			'username' => 'required|unique:users,username',
			'password' => 'required'
		]);

		// Génération token api
		$token = bin2hex(openssl_random_pseudo_bytes(16));

		$user = User::create([
			'lastname' => ucfirst($request->lastname),
			'firstname' => ucfirst($request->firstname),
			'email' => $request->email,
			'username' => ucfirst($request->username),
			'password' => app('hash')->make($request->password),
			'api_token' => $token,
		]);

		return response()->json(['created' => $user]);
	}

	public function update(Request $request) {
		$auth = Auth::user();
		$user = User::find($auth->id);

		$request->offsetUnset('password');
		$updated = $user->update($request->all());

		return response()->json(['updated' => $updated]);
	}

	public function updatePass(Request $request) {
		$auth = Auth::user();
		$user = User::find($auth->id);

		$this->validate($request, [
			'password' => 'required'
		]);

		if (isset($request->password) != '') {
			$user->password = app('hash')->make($request->password);
			$updated = $user->save();
		}

		return response()->json(['updated' => $updated]);
	}

	public function delete(Request $request) {
		$auth = Auth::user();
		$count = User::destroy($auth->id);

		return response()->json(['deleted' => $count == 1]);
	}
}

?>