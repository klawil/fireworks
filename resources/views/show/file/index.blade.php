@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2>{{ $show->name }} Files</h2>
      </div>

      <div class="panel-body">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>File</th>
              <th>Uploaded By</th>
              <th>Uploaded</th>
              <th>Viewable By</th>
              <th><!-- View --></th>
              <th><!-- Edit --></th>
              @can('delete', $show)
                <th><!-- Delete --></th>
              @endcan
            </tr>
          </thead>
          <tbody>
            @foreach($show->files as $file)
              <tr>
                <td>{{ $file->pivot->relationship }}</td>
                <td>{{ $file->user()->first()->name }}</td>
                <td>{{ $file->created_at->diffForHumans() }}</td>
                <td>{{ $file->pivot->getRoles() }}</td>
                <td>
                  <a href="{{ route('file.show', ['file' => $file]) }}" class="btn btn-info btn-block">View</a>
                </td>
                <td>
                  <a href="{{ route('show.file.edit', ['show' => $show, 'file' => $file]) }}" class="btn btn-info btn-block">Edit File</a>
                </td>
                @can('delete', $show)
                  <td>
                    <form method="POST" action="{{ route('show.file.destroy', ['show' => $show, 'file' => $file]) }}">
                      {{ csrf_field() }}
                      {{ method_field('DELETE') }}
                      <input type="submit" class="btn btn-danger btn-block" value="Remove File">
                    </form>
                  </td>
                @endcan
              </tr>
            @endforeach
            <tr>
              <td colspan="8"><a href="{{ route('show.file.create', ['show' => $show]) }}" class="btn btn-primary btn-block">Add a File</a></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
