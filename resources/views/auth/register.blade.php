@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>Register</h4>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('register') }}">
            {{ csrf_field() }}

            @include('assets.input', [
              'label' => 'Name *',
              'name' => 'name',
              'required' => true,
              'autofocus' => true,
            ])

            @include('assets.input', [
              'label' => 'E-Mail Address *',
              'name' => 'email',
              'type' => 'email',
              'required' => true,
            ])

            @include('assets.input', [
              'label' => 'Phone Number',
              'name' => 'phone',
              'type' => 'tel',
            ])

            @include('assets.input', [
              'label' => 'Address',
              'name' => 'address',
              'placeholder' => 'Street Address',
            ])

            <div class="form-group">
                <label for="city" class="col-md-4 control-label"></label>

                <div class="col-md-3{{ $errors->has('city') ? ' has-error' : '' }}">
                    <input id="city" type="string" class="form-control" name="city" placeholder="City" value="{{ old('city') }}">

                    @if ($errors->has('city'))
                        <span class="help-block">
                            <strong>{{ $errors->first('city') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-md-3{{ $errors->has('state') ? ' has-error' : '' }}">
                    @include('assets.state', [
                      'required' => false,
                      'default' => null,
                    ])

                    @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            @include('assets.input', [
              'label' => 'Password *',
              'name' => 'password',
              'type' => 'password',
              'required' => true,
            ])

            @include('assets.input', [
              'label' => 'Confirm Password *',
              'name' => 'password-confirm',
              'type' => 'password',
              'required' => true,
            ])

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Register
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
