@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading text-center">Update {{ $show->name }}</div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('show.update', ['show' => $show]) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Show Name *</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $show->name }}" required autofocus>

                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
              <label for="price" class="col-md-4 control-label">Billed Price</label>

              <div class="col-md-6">
                <input id="price" type="number" class="form-control" name="price" value="{{ $show->price }}" autofocus>

                @if ($errors->has('price'))
                  <span class="help-block">
                    <strong>{{ $errors->first('price') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('planned_date') ? ' has-error' : '' }}">
              <label for="planned_date" class="col-md-4 control-label">Planned Date *</label>

              <div class="col-md-6">
                <input id="planned_date" type="date" class="form-control" name="planned_date" value="{{ $show->planned_date->format('Y-m-d') }}" autofocus>

                @if ($errors->has('planned_date'))
                  <span class="help-block">
                    <strong>{{ $errors->first('planned_date') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('planned_location') ? ' has-error' : '' }}">
              <label for="planned_location" class="col-md-4 control-label">Planned Location</label>

              <div class="col-md-6">
                <input id="planned_location" type="text" class="form-control" name="planned_location" value="{{ $show->planned_location }}" autofocus>

                @if ($errors->has('planned_location'))
                  <span class="help-block">
                    <strong>{{ $errors->first('planned_location') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('rain_date') ? ' has-error' : '' }}">
              <label for="rain_date" class="col-md-4 control-label">Rain Date</label>

              <div class="col-md-6">
                <input id="rain_date" type="date" class="form-control" name="rain_date" value="{{ $show->rain_date ? $show->rain_date->format('Y-m-d') : '' }}" autofocus>

                @if ($errors->has('rain_date'))
                  <span class="help-block">
                    <strong>{{ $errors->first('rain_date') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('rain_location') ? ' has-error' : '' }}">
              <label for="rain_location" class="col-md-4 control-label">Rain Location</label>

              <div class="col-md-6">
                <input id="rain_location" type="text" class="form-control" name="rain_location" value="{{ $show->rain_location }}" autofocus>

                @if ($errors->has('rain_location'))
                  <span class="help-block">
                    <strong>{{ $errors->first('rain_location') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Save Show
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
