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
      ->limit(20)
      ->get();

    $PastShows = $Request
      ->user()
      ->shows()
      ->where('planned_date', '<', \Carbon\Carbon::today())
      ->orderBy('planned_date', 'desc')
      ->limit(20)
      ->get();

    $ViewableUsers = $Request
      ->user()
      ->userCanSee()
      ->orderBy('last_name', 'asc')
      ->orderBy('first_name', 'asc')
      ->limit(20)
      ->get();

    $ViewingUsers = $Request
      ->user()
      ->canSeeUser()
      ->orderBy('last_name', 'asc')
      ->orderBy('first_name', 'asc')
      ->limit(20)
      ->get();

    return view(
      'home',
      [
        'upcoming' => $UpcomingShows,
        'past' => $PastShows,
        'viewable' => $ViewableUsers,
        'viewers' => $ViewingUsers,
        'title' => 'Home',
      ]
    );
  }
}
