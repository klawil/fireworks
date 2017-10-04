@extends('layouts.app')

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading text-center">Edit <strong>{{ $user->name }}</strong>'s Relationship to <strong>{{ $show->name }}</strong></div>

        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="{{ route('show.user.update', ['show' => $show, 'user' => $user]) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
              <label for="is_owner" class="col-md-4 control-label">Select the User's Role(s)</label>

              <div class="col-md-6{{ $errors->has('is_owner') ? ' has-error' : '' }}">
                <input type="hidden" name="is_owner" value="0">
                <div class="checkbox form-control" style="border:none;box-shadow:none;">
                  <label>
                    <input id="is_owner" name="is_owner" type="checkbox"{{ old('is_owner', $user->pivot->is_owner) ? ' checked' : '' }} value="1">
                    Show Owner (Can: edit show, add users, see all files)
                  </label>
                </div>

                @if ($errors->has('is_owner'))
                <span class="help-block">
                  <strong>{{ $errors->first('is_owner') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="is_driver" class="col-md-4 control-label"></label>

              <div class="col-md-6{{ $errors->has('is_driver') ? ' has-error' : '' }}">
                <input type="hidden" name="is_driver" value="0">
                <div class="checkbox form-control" style="border:none;box-shadow:none;">
                  <label>
                    <input id="is_driver" name="is_driver" type="checkbox"{{ old('is_driver', $user->pivot->is_driver) ? ' checked' : '' }} value="1">
                    Driver (Can: view show, see driver files)
                  </label>
                </div>

                @if ($errors->has('is_driver'))
                <span class="help-block">
                  <strong>{{ $errors->first('is_driver') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="is_shooter" class="col-md-4 control-label"></label>

              <div class="col-md-6{{ $errors->has('is_shooter') ? ' has-error' : '' }}">
                <input type="hidden" name="is_shooter" value="0">
                <div class="checkbox form-control" style="border:none;box-shadow:none;">
                  <label>
                    <input id="is_shooter" name="is_shooter" type="checkbox"{{ old('is_shooter', $user->pivot->is_shooter) ? ' checked' : '' }} value="1">
                    Shooter (Can: view show, see shooter files)
                  </label>
                </div>

                @if ($errors->has('is_shooter'))
                <span class="help-block">
                  <strong>{{ $errors->first('is_shooter') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <label for="is_assistant" class="col-md-4 control-label"></label>

              <div class="col-md-6{{ $errors->has('is_assistant') ? ' has-error' : '' }}">
                <input type="hidden" name="is_assistant" value="0">
                <div class="checkbox form-control" style="border:none;box-shadow:none;">
                  <label>
                    <input id="is_assistant" name="is_assistant" type="checkbox"{{ old('is_assistant', $user->pivot->is_assistant) ? ' checked' : '' }} value="1">
                    Assistant (Can: view show, see assistant files)
                  </label>
                </div>

                @if ($errors->has('is_assistant'))
                <span class="help-block">
                  <strong>{{ $errors->first('is_assistant') }}</strong>
                </span>
                @endif
              </div>
            </div>

            <div class="form-group{{ $errors->has('payment') ? ' has-error' : '' }}">
              <label for="payment" class="col-md-4 control-label">How much will this person be paid for the show?</label>

              <div class="col-md-6">
                <input id="payment" type="number" class="form-control" name="payment" value="{{ old('payment', $user->pivot->payment) }}">

                @if ($errors->has('payment'))
                  <span class="help-block">
                    <strong>{{ $errors->first('payment') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-block">
                  Save
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
