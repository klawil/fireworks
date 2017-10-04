@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading text-center">
          <h4>Login</h4>
        </div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            @include('assets.input', [
              'label' => 'E-Mail Address',
              'name' => 'email',
              'type' => 'email',
              'required' => true,
              'autofocus' => true,
            ])

            @include('assets.input', [
              'label' => 'Password',
              'name' => 'password',
              'type' => 'password',
              'required' => true,
            ])

            @include('assets.checkbox', [
              'label' => 'Remember Me',
              'name' => 'remember',
              'default' => true,
            ])

            <div class="form-group">
              <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Login
                </button>

                <a class="btn btn-link" href="{{ route('password.request') }}">
                  Forgot Your Password?
                </a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
