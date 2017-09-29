@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>{{ $contact->name }} for {{ $show->name }}</h4>
        </div>

        <div class="panel-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th>Name</th>
                <td>{{ $contact->name }}</td>
              </tr>
              @if($contact->description !== NULL)
                <tr>
                  <th>Description</th>
                  <td>{{ $contact->description }}</td>
                </tr>
              @endif
              <tr>
                <th>Phone Number</th>
                <td>{{ $contact->phone or 'N/A' }}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>{{ $contact->email or 'N/A' }}</td>
              </tr>
              @can('update', $contact)
                <tr>
                  <td colspan="3">
                    <a href="{{ route('show.contact.edit', ['contact' => $contact]) }}" class="btn btn-primary btn-block">Edit Contact</a>
                  </td>
                </tr>
              @endcan
              @can('delete', $contact)
                <tr>
                  <td colspan="3">
                    <form action="{{ route('show.contact.destroy', ['contact' => $contact]) }}" method="POST">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}

                      <button type="submit" class="btn btn-danger btn-block">Delete Contact</button>
                    </form>
                  </td>
                </tr>
              @endcan
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection
