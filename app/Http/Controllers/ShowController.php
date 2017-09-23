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
    } else {
      $Shows = $Shows
        ->where('planned_date', '>=', \Carbon\Carbon::today())
        ->orderBy('planned_date', 'asc');
    }

    return view('show.index', [
      'shows' => $Shows->get(),
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
    return redirect()->route('show.show', [
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
      ->route('show.show', ['show' => $show]);
  }
}
