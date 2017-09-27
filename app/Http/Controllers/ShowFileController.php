<?php

namespace App\Http\Controllers;

use App\File;
use App\Show;
use Illuminate\Http\Request;

class ShowFileController extends Controller
{
  /**
   * The validation rules for a file and show
   */
  private $rules = [
    'relationship' => 'required|string|max:255',
    'driver_viewable' => 'required|boolean',
    'shooter_viewable' => 'required|boolean',
    'assistant_viewable' => 'required|boolean',
  ];

  /**
   * Display a listing of the resource.
   *
   * @param  Show     $show
   * @return Response
   */
  public function index(Show $show)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Return the view
    return view('show.file.index', [
      'show' => $show,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param  Show     $show
   * @return Response
   */
  public function create(Show $show)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Return the view
    return view('show.file.create', [
      'show' => $show,
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  Show     $show
   * @param  Request  $request
   * @return Response
   */
  public function store(Show $show, Request $request)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Add the file requirement to the rules
    $this->rules['file'] = 'required|file';

    // Validate the request
    $request->validate($this->rules);

    // Store the file
    $Path = $request
      ->file('file')
      ->store(\Carbon\Carbon::today()->format('Y/m/d'));

    // Create the file model
    $file = new File();
    $file->storage_name = $Path;
    $file->user_id = $request->user()->id;
    $file->file_name = $request->file('file')->getClientOriginalName();
    $file->mimetype = Storage::mimeType($Path);
    $file->save();

    // Save the relationship to the show
    $show
      ->files()
      ->save($file, [
        'relationship' => $request->input('relationship'),
        'driver_viewable' => $request->input('driver_viewable'),
        'shooter_viewable' => $request->input('shooter_viewable'),
        'assistant_viewable' => $request->input('assistant_viewable'),
      ]);

    // Return to the upload page
    return redirect()
      ->route('show.file.create', [
        'show' => $show,
      ])
      ->with([
        'message' => $request->input('relationship') . ' Uploaded Successfully',
      ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Show     $show
   * @param  File     $file
   * @return Response
   */
  public function edit(Show $show, File $file)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Return the view
    return view('show.file.edit', [
      'show' => $show,
      'file' => $show
        ->files
        ->find($file),
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  Request  $request
   * @param  Show     $show
   * @param  File     $file
   * @return Response
   */
  public function update(Request $request, Show $show, File $file)
  {
    // Authorize the request
    $this->authorize('delete', $show);

    // Validate the request
    $request->validate($this->rules);

    // Get the relationship
    $relationship = $show
      ->files
      ->find($file)
      ->pivot;

    // Save the new values
    $relationship->relationship = $request->input('relationship');
    $relationship->driver_viewable = $request->input('driver_viewable');
    $relationship->shooter_viewable = $request->input('shooter_viewable');
    $relationship->assistant_viewable = $request->input('assistant_viewable');
    $relationship->save();

    // Return to the index page
    return redirect()
      ->route('show.file.index', [
        'show' => $show,
      ])
      ->with([
        'message' => $relationship->relationship . ' Updated',
      ]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Show     $show
   * @param  File     $file
   * @return Response
   */
  public function destroy(Show $show, File $file)
  {
    //
  }
}
