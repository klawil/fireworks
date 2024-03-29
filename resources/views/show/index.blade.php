@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>{{ $title }}</h4>
        </div>

        <div class="panel-body">
          @if(count($shows) === 0)
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
              @foreach($shows as $show)
              <tr>
                <td>{{ $show->planned_date->format('D, M j, Y') }}</td>
                <td>{{ $show->name }}</td>
                <td>
                  <a class="btn btn-success pull-right" href="{{ route('show.show', ['show' => $show]) }}">View Show</a>
                </td>
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
