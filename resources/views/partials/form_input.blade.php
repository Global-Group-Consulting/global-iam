<div class="mb-3">
  <label for="{{$name}}Input" class="form-label">
    {{$label}}
  </label>
  <input type="text" class="form-control @error($name) is-invalid @enderror"
    id="{{$name}}Input" name="{{$name}}" value="{{ $value ?? '' }}">
  @error($name)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
