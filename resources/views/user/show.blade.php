@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>{{ $user->last_name }}, {{ $user->first_name }}</h4>
        </div>

        <div class="panel-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th>First Name</th>
                <td>{{ $user->first_name }}</td>
              </tr>
              <tr>
                <th>Last Name</th>
                <td>{{ $user->last_name }}</td>
              </tr>
              @can('view', $user)
              <tr>
                <th>Phone Number</th>
                <td>{{ $user->phone or 'N/A' }}</td>
              </tr>
              <tr>
                <th>Email</th>
                <td>{{ $user->email or 'N/A' }}</td>
              </tr>
              <tr>
                <th>City/State</th>
                <td>{{ $user->city && $user->state ? $user->city . ', ' . $user->state : 'N/A' }}</td>
              </tr>
              @endcan
              @can('update', $user)
              <tr>
                <td colspan="2">
                  <a href="{{ route('user.edit', ['user' => $user]) }}" class="btn btn-primary btn-block">Edit User</a>
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
