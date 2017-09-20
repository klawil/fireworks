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
                <td>{{ $show->planned_date }}</td>
                <td>{{ $show->name }}</td>
                <td>
                  <a class="btn btn-success" href="/">View Show</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <a class="btn btn-info btn-block" href="/">See All Future Shows</a>
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
                <td>{{ $show->planned_date }}</td>
                <td>{{ $show->name }}</td>
                <td>
                  <a class="btn btn-success" href="/">View Show</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <a class="btn btn-info btn-block" href="/">See All Past Shows</a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
