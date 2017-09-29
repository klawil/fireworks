@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>{{ $title }}</h4>
        </div>

        <div class="panel-body">
          @if(count($show->contacts) === 0)
          <h4>There isn't anything here! Try <a href="{{ route('show.contact.create', ['show' => $show]) }}">creating a contact</a></h4>
          @else
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($show->contacts as $contact)
                @can('view', $contact)
                  <tr>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone or 'N/A' }}</td>
                    <td>{{ $contact->email or 'N/A' }}</td>
                    <td><a href="{{ route('show.contact.show', ['contact' => $contact]) }}" class="btn btn-info btn-block">View</a>
                  </tr>
                @endcan
              @endforeach
              <tr>
                <td colspan="4">
                  <a href="{{ route('show.contact.create', ['show' => $show]) }}" class="btn btn-primary btn-block">Create Contact</a>
                </td>
              </tr>
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
