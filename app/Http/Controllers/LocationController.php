<?php

namespace App\Http\Controllers;
use Auth;
use App\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationController extends Controller {

	public function allDate() {
		$location = Location::whereDate('updated_at', '=', date('Y-m-d'))->get();

		return response()->json($location);
	}

	public function create(Request $request) {
		$auth = Auth::user();

		$this->validate($request, [
			'latitude' => 'required',
			'longitude' => 'required'
		]);

		$location = Location::where('username', $auth->username)->orderBy('id', 'DESC')->first();

		if ($location) {
			$create = "Already location with this username";
			update($request);
		} else {

			$create = Location::create([
				'user_id' => $auth->id,
				'username' => $auth->username,
				'latitude' => $request->latitude,
				'longitude' => $request->longitude
			]);

		}

		return response()->json(['create' => $create]);
	}

	public function update(Request $request) {
		$auth = Auth::user();

		$this->validate($request, [
			'latitude' => 'required',
			'longitude' => 'required'
		]);

		$location = Location::where('username', $auth->username)->orderBy('id', 'DESC')->first();
		$updated = $location->update($request->all());

		return response()->json(['update' => $updated]);
	}
}

?>