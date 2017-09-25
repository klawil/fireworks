<?php

namespace App\Http\Controllers;

use \Storage;
use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
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
}
