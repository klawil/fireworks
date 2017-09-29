@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>{{ $user->first_name }} {{ $user->last_name }} {{ $license->type }} License</h4>
        </div>

        <div class="panel-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th>License Type</th>
                <td>{{ $license->type }}</td>
              </tr>
              <tr>
                <th>Valid</th>
                <td>{{ $license->issue_date->format('Y/m/d') }} to {{ $license->expire_date->format('Y/m/d') }}</td>
              </tr>
              <tr>
                <th>State</th>
                <td>{{ $license->state }}</td>
              </tr>
              <tr>
                <th>License Number</th>
                <td>{{ $license->license_number or 'N/A' }}</td>
              </tr>
              @if($license->file !== NULL)
                <tr>
                  <th>License File</th>
                  <td><a href="{{ route('file.show', ['file' => $license->file]) }}" class="btn btn-info btn-block">View</a></td>
                </tr>
              @endif
              @can('update', $license)
                <tr>
                  <td colspan="3">
                    <a href="{{ route('user.license.edit', ['license' => $license]) }}" class="btn btn-primary btn-block">Edit License</a>
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
