<?php

namespace App\Http\Controllers;

use App\ShowUser;
use App\Show;
use App\User;
use Illuminate\Http\Request;

class ShowUserController extends Controller
{
  /**
   * The validation rules for a user and show
   */
  private $rules = [
    'is_owner' => 'required|boolean',
    'is_driver' => 'required|boolean',
    'is_shooter' => 'required|boolean',
    'is_assistant' => 'required|boolean',
    'payment' => 'nullable|numeric',
  ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Show $show)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Return the view
    return view('show.user.index', [
      'show' => $show,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param  Show    $show
   * @param  Request $request
   * @return Response
   */
  public function create(Show $show, Request $request)
  {
    // Authorize the request
    /**
     * The authorization is done via show because the show is what is required
     * to create or remove these fields
     */
    $this->authorize('delete', $show);

    // Return the view
    return view('show.user.create', [
      'show' => $show,
      'users' => $request
        ->user()
        ->userCanSee()
        ->withCount([
          'shows' => function($query) use ($show) {
            $query
              ->where('shows.id', $show->id);
          }
        ])
        ->orderBy('last_name', 'ASC')
        ->orderBy('first_name', 'ASC')
        ->get(),
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Show    $show
   * @param  Request $request
   * @return Response
   */
  public function store(Show $show, Request $request)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Add to the validation array
    $this->rules['user_id'] = 'required|exists:users,id';

    // Validate the request
    $request->validate($this->rules);

    // Get the user
    $user = \App\User::find($request->input('user_id'));

    // Check for a relationship
    $relationship = $show
      ->users
      ->find($user);

    if ($relationship !== null) {
      return redirect()
        ->route('show.user.edit', [
          'show' => $show,
          'user' => $user,
        ])
        ->with([
          'message' => 'Relationship Already Exists',
        ]);
    }

    // Make the association
    $show
      ->users()
      ->save($user, [
        'is_owner' => $request->input('is_owner'),
        'is_driver' => $request->input('is_driver'),
        'is_shooter' => $request->input('is_shooter'),
        'is_assistant' => $request->input('is_assistant'),
        'payment' => $request->input('payment'),
      ]);

    return redirect()
      ->route('show.user.create', [
        'show' => $show,
      ])
      ->with([
        'message' => $user->first_name . ' ' . $user->last_name . ' was added',
      ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Show   $show
   * @param  User   $user
   * @return Response
   */
  public function edit(Show $show, User $user)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Get the user with pivot data
    $userWithPivot = $show
      ->users
      ->find($user);

    // If the relationship doesn't exist return a create screen
    if ($userWithPivot === null) {
      return redirect()
        ->route('show.user.create', [
          'show' => $show,
        ])
        ->withInput([
          'user_id' => $user->id,
        ])
        ->with([
          'message' => 'User must be added to the show',
        ]);
    }

    return view('show.user.edit', [
      'show' => $show,
      'user' => $userWithPivot,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request $request
   * @param  Show    $show
   * @param  User    $user
   * @return Response
   */
  public function update(Request $request, Show $show, User $user)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Validate the request
    $request->validate($this->rules);

    // Get the relationship
    $relationship = $show
      ->users
      ->find($user)
      ->pivot;

    // Save the new values
    $relationship->is_owner = $request->input('is_owner');
    $relationship->is_driver = $request->input('is_driver');
    $relationship->is_shooter = $request->input('is_shooter');
    $relationship->is_assistant = $request->input('is_assistant');
    $relationship->payment = $request->input('payment');
    $relationship->save();

    // Return to the show view
    return redirect()
      ->route('show.show', [
        'show' => $show,
      ])
      ->with([
        'message' => $user->first_name . ' ' . $user->last_name . ' Updated',
      ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Show   $show
   * @param  User   $user
   * @return Response
   */
  public function destroy(Show $show, User $user)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Delete the relationship
    $relationship = $show
      ->users
      ->find($user)
      ->pivot
      ->delete();

    // Return to the show view
    return redirect()
      ->route('show.show', [
        'show' => $show,
      ])
      ->with([
        'message' => $user->first_name . ' ' . $user->last_name . ' Removed',
      ]);
  }
}
