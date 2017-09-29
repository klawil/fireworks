<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Show;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Show $show)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Return the view
    return view('show.contact.index', [
      'show' => $show,
      'title' => "{$show->name } Contacts",
      'breadcrumbs' => [
        [
          'text' => 'Shows',
          'url' => route('show.index'),
        ],
        [
          'text' => $show->name,
          'url' => route('show.show', [
            'show' => $show,
          ]),
        ],
        [
          'text' => 'Contacts',
          'url' => route('show.contact.index', [
            'show' => $show,
          ]),
        ],
      ],
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Show $show)
  {
    // Authorize the request
    $this->authorize('view', $show);

    // Return the view
    return view('show.contact.create', [
      'show' => $show,
      'title' => "Create {$show->name} Contact",
      'breadcrumbs' => [
        [
          'text' => 'Shows',
          'url' => route('show.index'),
        ],
        [
          'text' => $show->name,
          'url' => route('show.show', [
            'show' => $show,
          ]),
        ],
        [
          'text' => 'Contacts',
          'url' => route('show.contact.index', [
            'show' => $show,
          ]),
        ],
        [
          'text' => 'Create',
          'url' => route('show.contact.create', [
            'show' => $show,
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
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function show(Contact $contact)
  {
    // Authorize the request
    $this->authorize('view', $contact);

    // Return the view
    return view('show.contact.show', [
      'show' => $contact->show,
      'contact' => $contact,
      'title' => "{$contact->name} for {$contact->show->name}",
      'breadcrumbs' => [
        [
          'text' => 'Shows',
          'url' => route('show.index'),
        ],
        [
          'text' => $contact->show->name,
          'url' => route('show.show', [
            'show' => $contact->show,
          ]),
        ],
        [
          'text' => 'Contacts',
          'url' => route('show.contact.index', [
            'show' => $contact->show,
          ]),
        ],
        [
          'text' => $contact->name,
          'url' => route('show.contact.show', [
            'contact' => $contact,
          ]),
        ],
      ],
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function edit(Contact $contact)
  {
    // Authorize the request
    $this->authorize('update', $contact);

    // Return the view
    return view('show.contact.edit', [
      'show' => $contact->show,
      'contact' => $contact,
      'title' => "Edit {$contact->show->name} For {$contact->show->name}",
      'breadcrumbs' => [
        [
          'text' => 'Shows',
          'url' => route('show.index'),
        ],
        [
          'text' => $contact->show->name,
          'url' => route('show.show', [
            'show' => $contact->show,
          ]),
        ],
        [
          'text' => 'Contacts',
          'url' => route('show.contact.index', [
            'show' => $contact->show,
          ]),
        ],
        [
          'text' => $contact->name,
          'url' => route('show.contact.show', [
            'contact' => $contact,
          ]),
        ],
        [
          'text' => 'Edit',
          'url' => route('show.contact.edit', [
            'contact' => $contact,
          ]),
        ],
      ],
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Contact $contact)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Contact  $contact
   * @return \Illuminate\Http\Response
   */
  public function destroy(Contact $contact)
  {
    //
  }
}
