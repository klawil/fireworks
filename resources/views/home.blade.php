@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">Upcoming Shows</div>

        <div class="panel-body">
          @if(count($upcoming) === 0)
          <h4>There isn't anything here! Try <a href="{{ route('show.create') }}">creating a show</a></h4>
          @else
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($upcoming as $show)
              <tr>
                <td>{{ $show->planned_date->format('D, M j, Y') }}</td>
                <td>{{ $show->name }}</td>
                <td>
                  <a class="btn btn-info pull-right" href="{{ route('show.show', ['show' => $show]) }}">View Show</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="{{ route('show.create') }}">Create a Show</a>
          </div>
          <div class="visible-xs-block visible-sm-block" style="min-height:10px"></div>
          <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="{{ route('show.index', ['type' => 'future']) }}">See All Future Shows</a>
          </div>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">Past Shows</div>

        <div class="panel-body">
          @if(count($past) === 0)
          <h4>There isn't anything here! Try <a href="{{ route('show.create') }}">creating a show</a></h4>
          @else
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($past as $show)
              <tr>
                <td>{{ $show->planned_date->format('D, M j, Y') }}</td>
                <td>{{ $show->name }}</td>
                <td>
                  <a class="btn btn-info pull-right" href="{{ route('show.show', ['show' => $show]) }}">View Show</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="{{ route('show.create') }}">Create a Show</a>
          </div>
          <div class="visible-xs-block visible-sm-block" style="min-height:10px"></div>
          <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="{{ route('show.index', ['type' => 'past']) }}">See All Past Shows</a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    @if(count($viewable) > 0)
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">Viewable Users</div>

        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($viewable as $user)
              <tr>
                <td>{{ $user->last_name }}, {{ $user->first_name }}</td>
                <td>
                  <a class="btn btn-info pull-right" href="{{ route('user.show', ['user' => $user]) }}">View</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="{{ route('user.create') }}">Create a User</a>
          </div>
          <div class="visible-xs-block visible-sm-block" style="min-height:10px"></div>
          <div class="col-md-6">
            <a class="btn btn-primary btn-block" href="{{ route('user.index') }}">See All</a>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if(count($viewers) > 0)
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading text-center">Users That Can View You</div>

        <div class="panel-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($viewers as $user)
              <tr>
                <td>{{ $user->last_name }}, {{ $user->first_name }}</td>
                <td>
                  <a class="btn btn-success pull-right" href="/">View User</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <a class="btn btn-info btn-block" href="/">See All</a>
        </div>
      </div>
    </div>
    @endif
  </div>
@endsection
