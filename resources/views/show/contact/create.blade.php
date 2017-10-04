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

          @include('assets.input', [
            'label' => 'Contact Name *',
            'name' => 'name',
            'required' => true,
            'autofocus' => true,
          ])

          @include('assets.input', [
            'label' => 'Contact Description',
            'name' => 'description',
          ])

          @include('assets.input', [
            'label' => 'Phone Number',
            'name' => 'phone',
            'type' => 'tel',
          ])

          @include('assets.input', [
            'label' => 'Email',
            'name' => 'email',
            'type' => 'email',
          ])

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
