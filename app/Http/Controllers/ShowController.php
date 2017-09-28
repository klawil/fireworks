<?php

namespace App\Http\Controllers;

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
      'breadcrumbs' => [
        [
          'url' => route('show.index'),
          'text' => 'Shows',
        ],
        [
          'text' => $show->name,
          'url' => route('show.show', [
            'show' => $show,
          ]),
        ],
      ],
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
      'breadcrumbs' => [
        [
          'url' => route('show.index'),
          'text' => 'Shows',
        ],
        [
          'text' => $show->name,
          'url' => route('show.show', [
            'show' => $show,
          ]),
        ],
        [
          'text' => 'Edit',
          'url' => route('show.edit', [
            'show' => $show,
          ]),
        ],
      ],
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
}
