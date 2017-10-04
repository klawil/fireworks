@extends('layouts.app')

@section('content')
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading text-center">
        <h2>Edit {{ $contact->name }} for {{ $show->name }}</h2>
      </div>

      <div class="panel-body">
        <form action="{{ route('show.contact.update', ['contact' => $contact]) }}" method="POST" class="form-horizontal">
          {{ csrf_field() }}
          {{ method_field('PUT') }}

          @include('assets.input', [
            'label' => 'Contact Name *',
            'name' => 'name',
            'default' => $contact->name,
            'required' => true,
            'autofocus' => true,
          ])

          @include('assets.input', [
            'label' => 'Contact Description',
            'name' => 'description',
            'default' => $contact->description,
          ])

          @include('assets.input', [
            'label' => 'Phone Number',
            'name' => 'phone',
            'default' => $contact->phone,
            'type' => 'tel',
          ])

          @include('assets.input', [
            'label' => 'Email',
            'name' => 'email',
            'default' => $contact->email,
            'type' => 'email',
          ])

          <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
              <button type="submit" class="btn btn-primary btn-block">Update Contact</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
