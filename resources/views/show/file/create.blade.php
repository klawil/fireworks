@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2>Upload a File to {{ $show->name }}</h2>
      </div>

      <div class="panel-body">
        <form action="{{ route('show.file.store', ['show' => $show]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
          {{ csrf_field() }}

          <div class="form-group{{ $errors->has('relationship') ? ' has-error' : '' }}">
            <label for="relationship" class="col-md-4 control-label">What is this file?</label>

            <div class="col-md-6">
              <input id="relationship" name="relationship" type="text" class="form-control" value="{{ old('relationship') }}" required>

              @if ($errors->has('relationship'))
              <span class="help-block">
                <strong>{{ $errors->first('relationship') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
            <label for="file" class="col-md-4 control-label">Choose a file to upload</label>

            <div class="col-md-6">
              <input id="file" name="file" type="file" class="form-control" value="{{ old('file') }}" required>

              @if ($errors->has('file'))
              <span class="help-block">
                <strong>{{ $errors->first('file') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="driver_viewable" class="col-md-4 control-label">Who can view this file?</label>

            <div class="col-md-6{{ $errors->has('driver_viewable') ? ' has-error' : '' }}">
              <input type="hidden" name="driver_viewable" value="0">
              <div class="checkbox form-control" style="border:none;box-shadow:none;">
                <label>
                  <input id="driver_viewable" name="driver_viewable" type="checkbox"{{ old('driver_viewable') ? ' checked' : '' }} value="1">
                  Driver(s)
                </label>
              </div>

              @if ($errors->has('driver_viewable'))
              <span class="help-block">
                <strong>{{ $errors->first('driver_viewable') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="shooter_viewable" class="col-md-4 control-label"></label>

            <div class="col-md-6{{ $errors->has('shooter_viewable') ? ' has-error' : '' }}">
              <input type="hidden" name="shooter_viewable" value="0">
              <div class="checkbox form-control" style="border:none;box-shadow:none;">
                <label>
                  <input id="shooter_viewable" name="shooter_viewable" type="checkbox"{{ old('shooter_viewable') ? ' checked' : '' }} value="1">
                  Shooter(s)
                </label>
              </div>

              @if ($errors->has('shooter_viewable'))
              <span class="help-block">
                <strong>{{ $errors->first('shooter_viewable') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <label for="assistant_viewable" class="col-md-4 control-label"></label>

            <div class="col-md-6{{ $errors->has('assistant_viewable') ? ' has-error' : '' }}">
              <input type="hidden" name="assistant_viewable" value="0">
              <div class="checkbox form-control" style="border:none;box-shadow:none;">
                <label>
                  <input id="assistant_viewable" name="assistant_viewable" type="checkbox"{{ old('assistant_viewable') ? ' checked' : '' }} value="1">
                  Assistant(s)
                </label>
              </div>

              @if ($errors->has('assistant_viewable'))
              <span class="help-block">
                <strong>{{ $errors->first('assistant_viewable') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary btn-block">Upload File</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
