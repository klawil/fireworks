<?php

namespace App\Http\Controllers;

use App\ShowFile;
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
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @param  Show     $show
   * @return Response
   */
  public function create(Show $show)
  {
    //
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
    //
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
    //
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
    //
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
