@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2>{{ $show->name }}</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>Show Information</h4>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <th>Your Role(s)</th>
                <td>{{ $relationship->getRoles() }}</td>
              </tr>
              <tr>
                <th>Planned Date</th>
                <td>{{ $show->planned_date->format('D, M j, Y') }}</td>
              </tr>
              <tr>
                <th>Planned Location</th>
                <td>{{ $show->planned_location or "N/A" }}</td>
              </tr>
              <tr>
                <th>Rain Date</th>
                <td>{{ $show->rain_date ? $show->rain_date->format('D, M j, Y') : "N/A" }}</td>
              </tr>
              <tr>
                <th>Planned Location</th>
                <td>{{ $show->rain_location or "N/A" }}</td>
              </tr>
              @if($relationship->is_owner)
              <tr>
                <th>Quoted Price</th>
                <td>{{ $show->price ? '$' . number_format($show->price, 2) : "N/A" }}</td>
              </tr>
              @endif
              @if($relationship->payment)
              <tr>
                <th>Your Pay</th>
                <td>${{ number_format($relationship->payment, 2) }}</td>
              </tr>
              @endif
              @if($relationship->is_owner)
              <tr>
                <td colspan="2"><a href="{{ route('show.edit', ['show' => $show]) }}" class="btn btn-primary btn-block">Edit Show</a></td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
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
                @endif
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
              </tr>
              @endforeach
              @if($relationship->is_owner)
              <tr>
                <td colspan="3"><a href="{{ route('show.user.index', ['show' => $show]) }}" class="btn btn-primary btn-block">Manage Users</a></td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
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
                  <td><a href="{{ route('file.show', ['file' => $file]) }}" class="btn btn-info btn-block">View</a>
                </tr>
                @endcan
              @endforeach
              <tr>
                <td colspan="4"><a href="{{ route('show.file.index', ['show' => $show]) }}" class="btn btn-primary btn-block">Manage Files</a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>Contacts</h4>
        </div>

        <div class="panel-body">
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
                <td colspan="4"><a href="{{ route('show.contact.index', ['show' => $show]) }}" class="btn btn-primary btn-block">Manage Contacts</a></td>
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
@endsection
