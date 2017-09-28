<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
  private $rules = [
    'first_name' => 'required|string|max:255',
    'last_name' => 'required|string|max:255',
    'email' => 'required|string|email|max:255|unique:users',
    'address' => 'nullable|max:255',
    'city' => 'nullable|max:255',
    'state' => 'nullable|max:3',
    'phone' => 'nullable|max:11',
  ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    // Get the users to display
    $Users = $request
      ->user()
      ->userCanSee()
      ->orderBy('last_name', 'ASC')
      ->orderBy('first_name', 'ASC')
      ->get();

    return view('user.index', [
      'users' => $Users,
      'breadcrumbs' => [
        [
          'text' => 'Users',
          'url' => route('user.index'),
        ],
      ],
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    // Return the view
    return view('user.create', [
      'breadcrumbs' => [
        [
          'text' => 'Users',
          'url' => route('user.index'),
        ],
        [
          'text' => 'Create',
          'url' => route('user.create'),
        ],
      ],
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Validate the user
    $request->validate($this->rules);

    // Create a new user
    $User = new User($request->all());

    // Save the user
    $User->save();

    // Add the creator
    $User
      ->canSeeUser()
      ->save($request->user(), [
        'can_edit' => True,
      ]);

    // Redirect to the new user's page
    return redirect()
      ->route('user.show', [
        'user' => $User,
      ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    // Return the view
    return view('user.show', [
      'user' => $user,
      'breadcrumbs' => [
        [
          'text' => 'Users',
          'url' => route('user.index'),
        ],
        [
          'text' => $user->first_name . ' ' . $user->last_name,
          'url' => route('user.show', [
            'user' => $user,
          ]),
        ],
      ],
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    // Authorize the request
    $this->authorize('update', $user);

    // Return the view
    return view('user.edit', [
      'user' => $user,
      'breadcrumbs' => [
        [
          'text' => 'Users',
          'url' => route('user.index'),
        ],
        [
          'text' => $user->first_name . ' ' . $user->last_name,
          'url' => route('user.show', [
            'user' => $user,
          ]),
        ],
        [
          'text' => 'Edit',
          'url' => route('user.edit', [
            'user' => $user,
          ]),
        ],
      ],
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
  {
    // Authorize the request
    $this->authorize('update', $user);

    // Tell the unique rule to ignore the current user
    $this->rules['email'] .= ',email,' . $user->id;

    // Validate the request
    $request->validate($this->rules);

    // Update the user
    $user->email = $request->input('email');
    $user->first_name = $request->input('first_name');
    $user->last_name = $request->input('last_name');
    $user->address = $request->input('address', null);
    $user->city = $request->input('city', null);
    $user->state = $request->input('state', null);
    $user->phone = $request->input('phone', null);
    $user->save();

    return redirect()
      ->route('user.show', [
        'user' => $user,
      ])
      ->with([
        'message' => 'User Updated',
      ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    // Authorize the request
    $this->authorize('delete', $user);

    // Delete the user
    $user->delete();

    // Return the home screen with a message
    return redirect('home')
      ->with([
        'message' => $user->first_name . ' ' . $user->last_name . ' Deleted',
      ]);
  }
}
