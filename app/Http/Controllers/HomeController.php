<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $Request)
  {
    $UpcomingShows = $Request
      ->user()
      ->shows()
      ->where('planned_date', '>=', \Carbon\Carbon::today())
      ->orderBy('planned_date', 'asc')
      ->get();

    $PastShows = $Request
      ->user()
      ->shows()
      ->where('planned_date', '<', \Carbon\Carbon::today())
      ->orderBy('planned_date', 'desc')
      ->get();

    return view(
      'home',
      [
        'upcoming' => $UpcomingShows,
        'past' => $PastShows,
      ]
    );
  }
}
