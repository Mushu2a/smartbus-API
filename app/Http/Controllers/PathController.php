<?php

namespace App\Http\Controllers;
use Auth;
use App\Path;
use App\Booking;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pathController extends Controller {

	public function index() {
		$path = Path::orderBy('created_at', 'DESC')->get();

		return response()->json($path);
	}

	public function find($id) {
		$path = Path::find($id);
		$user = User::where('id', $path->user_id)->first();

		return response()->json(['path' => $path, 'user' => $user]);
	}

	public function search(Request $request) {

		$this->validate($request, [
			'startCity' => 'required',
			'finnishCity' => 'required',
			'dateTo' => 'required',
			'dateFrom' => 'required'
		]);

		$dateTo = date_create_from_format('j.m.Y', $request->dateTo);
		$dateFrom = date_create_from_format('j.m.Y', $request->dateFrom);
		$dateTo = date_format($dateTo, 'Y-m-d');
		$dateFrom = date_format($dateFrom, 'Y-m-d');
		
		$paths = Path::where('startCity', '=', $request->startCity)
					->orWhere('finnishCity', '=', $request->finnishCity)
					->orWhere('date', '>=', $dateTo)
					->orWhere('date', '>=', $dateFrom)->get();

		return response()->json(['paths' => $paths]);
	}

	public function create(Request $request) {
		$auth = Auth::user();

		$this->validate($request, [
			'type' => 'required',
			'startCity' => 'required',
			'finnishCity' => 'required',
			'price' => 'required|numeric',
			'date' => 'required',
			'startTime' => 'required'
		]);

		$date = date_create_from_format('j.m.Y', $request->date);
		$date2 = date_format($date, 'Y-m-d');

		$path = Path::create([
			'user_id' => $auth->id,
			'bookingSeats' => 0,
			'remainingSeats' => $auth->number,
			'type' => $request->type,
			'startCity' => $request->startCity,
			'finnishCity' => $request->finnishCity,
			'price' => $request->price,
			'date' => $date2,
			'startTime' => $request->startTime
		]);

		return response()->json(['created' => $path]);
	}

	public function add(Request $request, $id) {
		$auth = Auth::user();
		$path = Path::find($id);
		$book = Booking::where('path_id', $path->id)
						->where('user_id', $auth->id)->get();

		if ($book->isEmpty()) {
			if ($path->bookingSeats < $path->remainingSeats) {
				$booking = Booking::create([
					'user_id' => $auth->id,
					'path_id' => $id
				]);

				// Met à jour le nombre de siège disponible
				$path->bookingSeats = $path->bookingSeats + 1;
				$updated = $path->save();
			} else {
				$booking = "You can't take this ticket";
			}
		} else {
			$booking = "You have already take this ticket";
		}

		return response()->json(['booking' => $booking]);
	}

	public function update(Request $request, $id) {
		$path = Path::find($id);

		if ($path == null) {
			$updated = 'Error no route for this ID';
		} else {
			$updated = $path->update($request->all());
		}

		return response()->json(['updated' => $updated]);
	}

	public function delete(Request $request, $id) {
		$count = Path::destroy($id);

		return response()->json(['deleted' => $count == 1]);
	}
}

?>