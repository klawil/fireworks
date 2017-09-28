@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2>{{ $show->name }} Users</h2>
      </div>

      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Role(s)</th>
              <th>Pay</th>
              <th></th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($show->users as $user)
              <tr>
                <td>{{ $user->last_name }}, {{ $user->first_name }}</td>
                <td>{{ $user->pivot->getRoles() }}</td>
                <td>{{ $user->pivot->payment ? '$' . number_format($user->pivot->payment, 2) : 'N/A' }}</td>
                <td><a href="{{ route('show.user.edit', ['show' => $show, 'user' => $user]) }}" class="btn btn-info btn-block">Edit Roles</a></td>
                <td>
                  <form method="POST" action="{{ route('show.user.destroy', ['show' => $show, 'user' => $user]) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="submit" class="btn btn-danger btn-block" value="Remove User">
                  </form>
                </td>
              </tr>
            @endforeach
            <tr>
              <td colspan="5"><a href="{{ route('show.user.create', ['show' => $show]) }}" class="btn btn-primary btn-block">Add a User</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
