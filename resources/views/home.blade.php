@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Upcoming Shows</div>

        <div class="panel-body">
          @if(count($upcoming) === 0)
          <h4>There isn't anything here! Try creating a show</h4>
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
                <th>{{ $show->planned_date }}</th>
                <th>{{ $show->name }}</th>
                <th>
                  <a class="btn btn-success" href="/">View Show</a>
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading">Past Shows</div>

        <div class="panel-body">
          @if(count($past) === 0)
          <h4>There isn't anything here! Try creating a show</h4>
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
                <th>{{ $show->planned_date }}</th>
                <th>{{ $show->name }}</th>
                <th>
                  <a class="btn btn-success" href="/">View Show</a>
                </th>
              </tr>
              @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
