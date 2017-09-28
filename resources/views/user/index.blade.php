@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">Users</div>

        <div class="panel-body">
          @if(count($users) === 0)
            <h4>There isn't anything here! Try <a href="{{ route('user.create') }}">creating a user</a></h4>
          @else
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Location</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                  <tr>
                    <td>{{ $user->last_name }}, {{ $user->first_name }}</td>
                    <td>{{ $user->city && $user->state ? $user->city . ', ' . $user->state : 'N/A' }}</td>
                    <td><a href="{{ route('user.show', ['user' => $user]) }}" class="btn btn-info btn-block">View</a></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
