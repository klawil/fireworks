@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h4>Edit {{ $license->type }} License for {{ $user->name }}</h4>
      </div>

      <div class="panel-body">
        <form action="{{ route('user.license.update', ['license' => $license]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          <div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
            <label for="type" class="col-md-4 control-label">License Type*</label>

            <div class="col-md-6">
              <input id="type" name="type" type="text" class="form-control" value="{{ old('type', $license->type) }}" required autofocus>

              @if($errors->has('type'))
                <span class="help-block">
                  <strong>{{ $errors->first('type') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <label for="file" class="col-md-4 control-label">Upload a Copy of the License</label>

            <div class="col-md-6">
              <input id="file" name="file" type="file" class="form-control">

              @if($errors->has('file'))
                <span class="help-block">
                  <strong>{{ $errors->first('file') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('license_number') ? ' has-error' : '' }}">
            <label for="license_number" class="col-md-4 control-label">License Number</label>

            <div class="col-md-6">
              <input id="license_number" name="license_number" type="text" class="form-control" value="{{ old('license_number', $license->license_number) }}">

              @if($errors->has('license_number'))
                <span class="help-block">
                  <strong>{{ $errors->first('license_number') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
            <label for="state" class="col-md-4 control-label">State*</label>

            <div class="col-md-6">
              @include('assets.state', [
                'required' => true,
                'default' => $license->state,
              ])

              @if($errors->has('state'))
                <span class="help-block">
                  <strong>{{ $errors->first('state') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('issue_date') ? ' has-error' : '' }}">
            <label for="issue_date" class="col-md-4 control-label">License Issue Date*</label>

            <div class="col-md-6">
              <input id="issue_date" name="issue_date" type="date" class="form-control" value="{{ old('issue_date', $license->issue_date->format('Y-m-d')) }}" required>

              @if($errors->has('issue_date'))
                <span class="help-block">
                  <strong>{{ $errors->first('issue_date') }}</strong>
                </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('expire_date') ? ' has-error' : '' }}">
            <label for="expire_date" class="col-md-4 control-label">License Expiration Date*</label>

            <div class="col-md-6">
              <input id="expire_date" name="expire_date" type="date" class="form-control" value="{{ old('expire_date', $license->expire_date->format('Y-m-d')) }}" required>

              @if($errors->has('expire_date'))
                <span class="help-block">
                  <strong>{{ $errors->first('expire_date') }}</strong>
                </span>
              @endif
            </div>
          </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Update License
                </button>
              </div>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection
