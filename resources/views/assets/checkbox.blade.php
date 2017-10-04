<!-- A checkbox input -->
<div class="form-group{{ $errors->has($name) ? ' has-error' : ''}}">
  <!-- The input -->
  <div class="col-md-6 col-md-offset-4">
    <!-- A hidden input for the default value -->
    <input
      type="hidden"
      name="{{ $name }}"
      value="0"
      >

    <!-- The checkbox -->
    <div class="checkbox form-control">
      <label>
        <input
          id="{{ $name }}"
          name="{{ $name }}"
          type="checkbox"
          {{ old($name, isset($default) ? $default : null) ? 'checked' : '' }}
          >
        {{ $label }}
      </label>
    </div>

    <!-- Errors -->
    @if ($errors->has($name))
      <span class="help-block">
        <strong>{{ $errors->first($name) }}</strong>
      </span>
    @endif
  </div>
</div>
