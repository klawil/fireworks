<!-- A form input field -->
<div class="form-group{{ $errors->has($name) ? ' has-error' : ''}}">
  <!-- The label for the field -->
  <label for="{{ $name }}" class="col-md-4 control-label">{{ $label }}</label>

  <!-- The input -->
  <div class="col-md-6">
    <input
      id="{{ $name }}"
      name="{{ $name }}"
      type="{{ $type or 'text' }}"
      class="form-control"
      placeholder="{{ $placeholder or '' }}"
      value="{{ old($name, isset($default) ? $default : null) }}"
      {{ isset($required) && $required ? 'required' : '' }}
      {{ isset($autofocus) && $autofocus ? 'autofocus' : '' }}
      >

    <!-- Errors -->
    @if ($errors->has($name))
      <span class="help-block">
        <strong>{{ $errors->first($name) }}</strong>
      </span>
    @endif
  </div>
</div>
