<?php

namespace App\Http\Controllers;
use Auth;
use App\Score;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ScoreController extends Controller {

	public function index() {
		$score = Score::orderBy('score', 'DESC')->limit(5)->get();

		return response()->json($score);
	}

	public function updateOrCreate(Request $request) {
		$auth = Auth::user();
		$user = Score::where('username', $auth->username)->orderBy('score', 'DESC')->first();

		if ($user) {
			$updateOrCreate = $user->update($request->all());
		} else {
			$this->validate($request, [
				'score' => 'required|integer'
			]);

			$updateOrCreate = Score::create([
				'user_id' => $auth->id,
				'username' => $auth->username,
				'score' => $request->score,
			]);
		}

		return response()->json(['updateOrCreate' => $updateOrCreate]);
	}
}

?>