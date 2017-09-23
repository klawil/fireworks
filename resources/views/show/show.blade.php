@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>{{ $show->name }}</h2>
        </div>
        <div class="panel-body">
          <table class="table table-striped">
            <tbody>
              <tr>
                <td>Your Role(s)</td>
                <td>{{ implode($roles, ', ') }}</td>
              </tr>
              <tr>
                <td>Planned Date</td>
                <td>{{ $show->planned_date->format('D, M j, Y') }}</td>
              </tr>
              <tr>
                <td>Planned Location</td>
                <td>{{ $show->planned_location or "N/A" }}</td>
              </tr>
              <tr>
                <td>Rain Date</td>
                <td>{{ $show->rain_date ? $show->rain_date->format('D, M j, Y') : "N/A" }}</td>
              </tr>
              <tr>
                <td>Planned Location</td>
                <td>{{ $show->rain_location or "N/A" }}</td>
              </tr>
              @if($relationship->is_owner)
              <tr>
                <td>Quoted Price</td>
                <td>{{ $show->price ? '$' . number_format($show->price, 2) : "N/A" }}</td>
              </tr>
              @endif
              @if($relationship->payment)
              <tr>
                <td>Your Pay</td>
                <td>${{ number_format($relationship->payment, 2) }}</td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>

        <div class="panel-body">
          <h4>Files</h4>

          <table class="table table-striped">
            <thead>
              <tr>
                <th>Name</th>
                <th>Uploaded By</th>
                <th>Uploaded</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($show->files as $file)
                @can('view', $file)
                <tr>
                  <td>{{ $file->pivot->relationship }}</td>
                  <td>{{ $file->user()->first()->last_name }}, {{ $file->user()->first()->first_name }}</td>
                  <td>{{ $file->created_at->diffForHumans() }}</td>
                  <td><a href="{{ route('file.show', ['file' => $file]) }}" class="btn btn-info btn-block">View File</a>
                </tr>
                @endcan
              @endforeach
            </tbody>
          </table>
        </div>

        <div class="panel-body">
          <h4 class="text-center">Upload a File</h4>

          <form action="{{ route('show.upload', ['show' => $show]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
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
        @can('delete', $show)
        <div class="panel-body">
          <form method="POST" action="{{ route('show.destroy', ['show' => $show]) }}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-danger btn-block" value="Delete Show">
          </form>
        </div>
        @endcan
      </div>
    </div>
  </div>
</div>
@endsection
