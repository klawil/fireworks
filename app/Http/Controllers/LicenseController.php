<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use App\File;
use App\License;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
  /**
   * The validation rules for a license
   */
  private $rules = [
    'type' => 'required|string|max:255',
    'state' => 'required|string|max:50',
    'license_number' => 'nullable|string|max:255',
    'issue_date' => 'required|date',
    'expire_date' => 'required|date',
  ];

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(User $user)
  {
    // Authorize the request
    $this->authorize('update', $user);

    // Return the view
    return view('user.license.create', [
      'user' => $user,
      'title' => 'Add License for ' . $user->first_name . ' ' . $user->last_name,
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
          'text' => 'Create License',
          'url' => route('user.license.create', [
            'user' => $user,
          ]),
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
  public function store(Request $request, User $user)
  {
    // Authorize the request
    $this->authorize('update', $user);

    // Add the file to the rules
    $this->rules['file'] = 'nullable|file';

    // Validate the request
    $request->validate($this->rules);

    // Create and store the file if needed
    $fileId = null;
    if ($request->file('file') !== NULL) {
      // Save the file
      $path = $request
        ->file('file')
        ->store(\Carbon\Carbon::today()->format('Y/m/d'));

      // Make the file model
      $file = new File();
      $file->storage_name = $path;
      $file->user_id = $request->user()->id;
      $file->file_name = $request->file('file')->getClientOriginalName();
      $file->mimetype = Storage::mimeType($path);
      $file->save();

      // Save the file ID
      $fileId = $file->id;
    }

    // Create and store the license
    $license = new License();
    $license->user_id = $user->id;
    $license->file_id = $fileId;
    $license->type = $request->input('type');
    $license->state = $request->input('state');
    $license->license_number = $request->input('license_number');
    $license->issue_date = $request->input('issue_date');
    $license->expire_date = $request->input('expire_date');
    $license->save();

    // Return to the create page
    return redirect()
      ->route('user.license.create', [
        'user' => $user,
      ])
      ->with([
        'message' => $license->type . ' License Created',
      ]);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\License  $license
   * @return \Illuminate\Http\Response
   */
  public function show(License $license)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\License  $license
   * @return \Illuminate\Http\Response
   */
  public function edit(License $license)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\License  $license
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, License $license)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\License  $license
   * @return \Illuminate\Http\Response
   */
  public function destroy(License $license)
  {
    //
  }
}
