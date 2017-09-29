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

      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>Licenses</h4>
        </div>

        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Type</th>
                <th>State</th>
                <th>Valid</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($user->licenses as $license)
                <tr>
                  <td>{{ $license->type }}</td>
                  <td>{{ $license->state }}</td>
                  <td>{{ $license->issue_date->format('Y M j') }} to {{ $license->expire_date->format('Y M j') }}</td>
                  <td><a href="{{ route('user.license.show', ['license' => $license]) }}" class="btn btn-info btn-block">View</a></td>
                </tr>
              @endforeach
              @can('update', $user)
                <tr>
                  <td colspan="10">
                    <a href="{{ route('user.license.create', ['user' => $user]) }}" class="btn btn-primary btn-block">Create License</a>
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
