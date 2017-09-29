@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2>Creat a Contact for {{ $show->name }}</h2>
      </div>

      <div class="panel-body">
        <form action="{{ route('show.contact.store', ['show' => $show]) }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Contact Name*</label>

            <div class="col-md-6">
              <input id="name" name="name" type="text" class="form-control" value="{{ old('name') }}" autofocus required>

              @if ($errors->has('name'))
              <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label for="description" class="col-md-4 control-label">Contact Description</label>

            <div class="col-md-6">
              <input id="description" name="description" type="text" class="form-control" value="{{ old('description') }}">

              @if ($errors->has('description'))
              <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
            <label for="phone" class="col-md-4 control-label">Phone Number</label>

            <div class="col-md-6">
              <input id="phone" name="phone" type="text" class="form-control" value="{{ old('phone') }}">

              @if ($errors->has('phone'))
              <span class="help-block">
                <strong>{{ $errors->first('phone') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Email</label>

            <div class="col-md-6">
              <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}">

              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary btn-block">Create Contact</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
