<?php

namespace App\Http\Controllers;

use \Storage;
use App\Show;
use App\ShowRole;
use Illuminate\Http\Request;

class ShowController extends Controller
{
  /**
   * The rules for a valid show
   * @var Array
   */
  private $rules = [
    'name' => 'required|string|max:255',
    'price' => 'nullable|numeric',
    'planned_date' => 'required|date',
    'planned_location' => 'nullable|string|max:255',
    'rain_date' => 'nullable|date',
    'rain_location' => 'nullable|string|max:255',
  ];

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $Shows = $request
      ->user()
      ->shows();

    if ($request->input('type', 'future') === 'past') {
      $Shows = $Shows
        ->where('planned_date', '<', \Carbon\Carbon::today())
        ->orderBy('planned_date', 'desc');
      $Title = 'Past Shows';
    } else {
      $Shows = $Shows
        ->where('planned_date', '>=', \Carbon\Carbon::today())
        ->orderBy('planned_date', 'asc');
      $Title = 'Future Shows';
    }

    return view('show.index', [
      'shows' => $Shows->get(),
      'title' => $Title,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('show.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // Validate the request
    $request->validate($this->rules);

    // Create a new show item
    $Show = new Show($request->all());

    // Save the show
    $Show->save();

    // Add the owner
    $Show
      ->users()
      ->save($request->user(), [
        'is_owner' => True,
      ]);

    // Redirect to the new show page
    return redirect()
      ->route('show.show', [
        'show' => $Show,
      ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Show  $show
   * @return \Illuminate\Http\Response
   */
  public function show(Show $show, Request $request)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Get the relationship to the show
    $ShowRelationship = $show
      ->users
      ->find($request->user());

    return view('show.show', [
      'show' => $show,
      'relationship' => $ShowRelationship->pivot,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Show  $show
   * @return \Illuminate\Http\Response
   */
  public function edit(Show $show)
  {
    // Authorize the request
    $this->authorize('update', $show);

    // Return the view
    return view('show.edit', [
      'show' => $show,
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Show  $show
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Show $show)
  {
    // Authorize the request
    $this->authorize('update', $show);

    // Validate the request
    $request->validate($this->rules);

    // Save the show values
    $show->name = $request->input('name');
    $show->price = $request->input('price', null);
    $show->planned_date = $request->input('planned_date');
    $show->planned_location = $request->input('planned_location', null);
    $show->rain_date = $request->input('rain_date', null);
    $show->rain_location = $request->input('rain_location', null);
    $show->save();

    // Return the redirect
    return redirect()
      ->route('show.show', [
        'show' => $show,
      ])
      ->with([
        'message' => 'Show Updated',
      ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Show  $show
   * @return \Illuminate\Http\Response
   */
  public function destroy(Show $show)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Delete the show
    $show->delete();

    // Return to the home screen with a message
    return redirect('home')
      ->with([
        'message' => $show->name . ' Deleted',
      ]);
  }

  /**
   * Show the form for uploading a file to the show
   * @param  Show   $show
   * @return Response
   */
  public function uploadForm(Show $show)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Return the view
    return view('show.upload', [
      'show' => $show,
    ]);
  }

  /**
   * Upload a file to a show
   * @param  Show     $show    The show to upload to
   * @param  Request  $request The request instance
   * @return Response          A redirect to the show page
   */
  public function upload(Show $show, Request $request)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Validate the request
    $request->validate([
      'file' => 'required|file',
      'relationship' => 'required|string|max:255',
      'driver_viewable' => 'required|boolean',
      'shooter_viewable' => 'required|boolean',
      'assistant_viewable' => 'required|boolean',
    ]);

    // Store the file in the
    $Path = $request
      ->file('file')
      ->store(\Carbon\Carbon::today()->format('Y/m/d'));

    // Create the file object
    $File = new \App\File();
    $File->storage_name = $Path;
    $File->user_id = $request->user()->id;
    $File->file_name = $request->file('file')->getClientOriginalName();
    $File->mimetype = Storage::mimeType($Path);

    // Save the file and the relationship
    $show
      ->files()
      ->save($File, [
        'relationship' => $request->input('relationship'),
        'driver_viewable' => $request->input('driver_viewable'),
        'shooter_viewable' => $request->input('shooter_viewable'),
        'assistant_viewable' => $request->input('assistant_viewable'),
      ]);

    return redirect()
      ->route('show.upload', [
        'show' => $show
      ])
      ->with([
        'message' => $request->input('relationship') . ' Uploaded Successfully',
      ]);
  }

  /**
   * Show the form for associating a new user
   *
   * @param  Show    $show
   * @param  Request $request
   * @return Response
   */
  public function userCreate(Show $show, Request $request)
  {
    // Authorize the request
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
   * Store a newly created association in storage
   *
   * @param  Show    $show
   * @param  Request $request
   * @return Response
   */
  public function userStore(Show $show, Request $request)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Validate the request
    $request->validate([
      'user_id' => 'required|exists:users,id',
      'is_owner' => 'required|boolean',
      'is_driver' => 'required|boolean',
      'is_shooter' => 'required|boolean',
      'is_assistant' => 'required|boolean',
      'payment' => 'nullable|numeric',
    ]);

    // Get the user
    $User = \App\User::find($request->input('user_id'));

    // Make the association
    $show
      ->users()
      ->save($User, [
        'is_owner' => $request->input('is_owner'),
        'is_driver' => $request->input('is_driver'),
        'is_shooter' => $request->input('is_shooter'),
        'is_assistant' => $request->input('is_assistant'),
        'payment' => $request->input('payment', null),
      ]);
    $Relationship = $show
      ->users
      ->find($User)
      ->pivot;

    return redirect()
      ->route('show.user.create', [
        'show' => $show,
      ])
      ->with([
        'message' => $User->first_name . ' ' . $User->last_name . ' was added as ' . $Relationship->getRoles(),
      ]);
  }

  /**
   * Show the form for editing the user-show association
   *
   * @param  Show    $show
   * @param  AppUser $user
   * @return Response
   */
  public function userEdit(Show $show, \App\User $user)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Get the user
    $User = $show
      ->users
      ->find($user);

    return view('show.user.edit', [
      'show' => $show,
      'user' => $User,
    ]);
  }

  /**
   * Update the specified resource in storage
   *
   * @param  Show    $show
   * @param  AppUser $user
   * @return Response
   */
  public function userUpdate(Show $show, \App\User $user, Request $request)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Validate the request
    $request->validate([
      'is_owner' => 'required|boolean',
      'is_driver' => 'required|boolean',
      'is_shooter' => 'required|boolean',
      'is_assistant' => 'required|boolean',
      'payment' => 'nullable|numeric',
    ]);

    // Get the relationship
    $Relationship = $show
      ->users
      ->find($user)
      ->pivot;

    // Save the new values
    $Relationship->is_owner = $request->input('is_owner');
    $Relationship->is_driver = $request->input('is_driver');
    $Relationship->is_shooter = $request->input('is_shooter');
    $Relationship->is_assistant = $request->input('is_assistant');
    $Relationship->payment = $request->input('payment');
    $Relationship->save();

    // Return to the show view
    return redirect()
      ->route('show.show', [
        'show' => $show,
      ])
      ->with([
        'message' => $user->first_name . ' ' . $user->last_name . ' Updated',
      ]);
  }
}
