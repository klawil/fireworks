@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2>Edit {{ $file->pivot->relationship }} For {{ $show->name }}</h2>
      </div>

      <div class="panel-body">
        <form action="{{ route('show.file.update', ['show' => $show, 'file' => $file]) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
          {{ csrf_field() }}
          {{ method_field('PUT') }}


          @include('assets.input', [
            'label' => 'What is this file?',
            'name' => 'relationship',
            'default' => $file->pivot->relationship,
            'required' => true,
            'autofocus' => true,
          ])

          @include('assets.input', [
            'label' => 'Choose a file to upload',
            'name' => 'file',
            'type' => 'file',
            'required' => true,
          ])

          <div class="form-group">
            <label class="col-md-4 control-label">Who can view this file?</label>
          </div>

          @include('assets.checkbox', [
            'label' => 'Driver(s)',
            'name' => 'driver_viewable',
            'default' => $file->pivot->driver_viewable,
          ])

          @include('assets.checkbox', [
            'label' => 'Shooter(s)',
            'name' => 'shooter_viewable',
            'default' => $file->pivot->shooter_viewable,
          ])

          @include('assets.checkbox', [
            'label' => 'Assistant(s)',
            'name' => 'assistant_viewable',
            'default' => $file->pivot->assistant_viewable
          ])

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary btn-block">Update File</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
