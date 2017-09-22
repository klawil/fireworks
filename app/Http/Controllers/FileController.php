<?php

namespace App\Http\Controllers;

use \Storage;
use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\File  $file
   * @return \Illuminate\Http\Response
   */
  public function show(File $file)
  {
    // Authorize the user
    $this->authorize('view', $file);

    // Return the file
    return \Response(Storage::get($file->storage_name), 200)
      ->header('Content-Type', $file->mimetype)
      ->header('Content-Disposition', 'inline; filename="' . $file->file_name . '"');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\File  $file
   * @return \Illuminate\Http\Response
   */
  public function destroy(File $file)
  {
    // Authorize the user
    $this->authorize('delete', $file);

    //
  }
}
