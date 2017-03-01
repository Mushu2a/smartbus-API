<?php

namespace App\Http\Controllers;
use Auth;
use App\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class bookingController extends Controller {

	public function index() {
		$auth = Auth::user();
		$booking = Booking::with(['user','path'])->where('user_id', $auth->id)->get();

		return response()->json(['booking' => $booking]);
	}
}

?>