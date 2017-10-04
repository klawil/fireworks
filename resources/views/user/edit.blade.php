@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>Edit {{ $user->name }}</h4>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('user.update', ['user' => $user]) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="name" class="col-md-4 control-label">Name *</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required autofocus>

                @if ($errors->has('name'))
                  <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label">E-Mail Address *</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>

                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone" class="col-md-4 control-label">Phone Number</label>

              <div class="col-md-6">
                <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone', $user->phone) }}">

                @if ($errors->has('phone'))
                  <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
              <label for="address" class="col-md-4 control-label">Address</label>

              <div class="col-md-6">
                <input id="address" type="string" class="form-control" name="address" placeholder="Address" value="{{ old('address', $user->address) }}">

                @if ($errors->has('address'))
                  <span class="help-block">
                    <strong>{{ $errors->first('address') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="city" class="col-md-4 control-label"></label>

              <div class="col-md-3{{ $errors->has('city') ? ' has-error' : '' }}">
                <input id="city" type="string" class="form-control" name="city" placeholder="City" value="{{ old('city', $user->city) }}">

                @if ($errors->has('city'))
                  <span class="help-block">
                    <strong>{{ $errors->first('city') }}</strong>
                  </span>
                @endif
              </div>

              <div class="col-md-3{{ $errors->has('state') ? ' has-error' : '' }}">
                @include('assets.state', [
                  'required' => false,
                  'default' => $user->state,
                ])

                @if ($errors->has('state'))
                  <span class="help-block">
                    <strong>{{ $errors->first('state') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Save User
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
