<select id="state" name="state" class="form-control"{{ $required ? ' required' : '' }}>
  <option{{ old('state', $default) === null ? ' selected' : '' }} disabled>State</option>
  @foreach($states as $state)
    <option{{ old('state', $default) === $state ? ' selected' : '' }} value="{{ $state }}">{{ $state }}</option>
  @endforeach
</select>
