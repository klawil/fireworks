@extends('layouts.app')

@section('content')
<div class="container">
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h2 class="text-center">{{ $show->name }}</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Show Information</h4>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td>Your Role(s)</td>
                <td>{{ $relationship->getRoles() }}</td>
              </tr>
              <tr>
                <td>Planned Date</td>
                <td>{{ $show->planned_date->format('D, M j, Y') }}</td>
              </tr>
              <tr>
                <td>Planned Location</td>
                <td>{{ $show->planned_location or "N/A" }}</td>
              </tr>
              <tr>
                <td>Rain Date</td>
                <td>{{ $show->rain_date ? $show->rain_date->format('D, M j, Y') : "N/A" }}</td>
              </tr>
              <tr>
                <td>Planned Location</td>
                <td>{{ $show->rain_location or "N/A" }}</td>
              </tr>
              @if($relationship->is_owner)
              <tr>
                <td>Quoted Price</td>
                <td>{{ $show->price ? '$' . number_format($show->price, 2) : "N/A" }}</td>
              </tr>
              @endif
              @if($relationship->payment)
              <tr>
                <td>Your Pay</td>
                <td>${{ number_format($relationship->payment, 2) }}</td>
              </tr>
              @endif
              @if($relationship->is_owner)
              <tr>
                <td colspan="2"><a href="" class="btn btn-primary btn-block">Edit Show</a></td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Users</h4>
        </div>

        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Role(s)</th>
                @if($relationship->is_owner)
                <th>Pay</th>
                <th></th>
                @endif
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($show->users as $user)
              <tr>
                <td>{{ $user->last_name }}, {{ $user->first_name }}</td>
                <td>{{ $user->pivot->getRoles() }}</td>
                @if($relationship->is_owner)
                <td>{{ $user->pivot->payment ? '$' . number_format($user->pivot->payment, 2) : 'N/A' }}</td>
                @endif
                @if($relationship->is_owner)
                <td>
                  <a class="btn btn-info btn-block">Edit Roles</a>
                </td>
                @endif
                <td>
                  @if($relationship->is_owner || $relationship->user_id === $user->id)
                  <a class="btn btn-danger btn-block">Remove User</a>
                  @endif
                </td>
              </tr>
              @endforeach
              @if($relationship->is_owner)
              <tr>
                <td colspan="5"><a href="" class="btn btn-primary btn-block">Add a User</a></td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Show Files</h4>
        </div>

        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Uploaded By</th>
                <th>Uploaded</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($show->files as $file)
                @can('view', $file)
                <tr>
                  <td>{{ $file->pivot->relationship }}</td>
                  <td>{{ $file->user()->first()->last_name }}, {{ $file->user()->first()->first_name }}</td>
                  <td>{{ $file->created_at->diffForHumans() }}</td>
                  <td><a href="{{ route('file.show', ['file' => $file]) }}" class="btn btn-info btn-block">View File</a>
                </tr>
                @endcan
              @endforeach
              <tr>
                <td colspan="4"><a href="{{ route('show.upload', ['show' => $show]) }}" class="btn btn-primary btn-block">Upload a File</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    @can('delete', $show)
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-body">
          <form method="POST" action="{{ route('show.destroy', ['show' => $show]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-danger btn-block" value="Delete Show">
          </form>
        </div>
      </div>
    </div>
    @endcan
  </div>
</div>
@endsection
