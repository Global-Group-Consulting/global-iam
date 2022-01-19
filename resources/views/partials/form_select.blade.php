@php
  if(!isset($name)){
    $name = "";
  }

  $isMultiple = isset($multiple) && $multiple;
  $selectName = $isMultiple ? $name . "[]" : $name;
  $errorName = $isMultiple ? $name . ".*" : $name;
@endphp

<div class="mb-3">
  <label for="{{$name}}Select" class="form-label">
    {{$label}}
  </label>

  <select class="form-select @error($errorName) is-invalid @enderror"
          {{$isMultiple ? 'multiple' : ''}}
          id="{{$name}}Select"
          size="{{ $size ?? ($isMultiple ? 2 : 1) }}"
          name="{{$selectName}}">
    @foreach($options as $option)

      @php
        $optionValue = isset($optionsKey) ? $option[$optionsKey] : $option["value"];
        $optionLabel = isset($optionsText) && key_exists("fn", $optionsText) ?
        $optionsText["fn"]($option) : $option["text"] ;
        $selected = $value === $optionValue;

        if(is_array($value)){
          $selected = in_array($optionValue, $value);
        }
      @endphp

      <option value="{{$optionValue}}" {{ $selected ? "selected" : '' }}>
        {{ $optionLabel }}
      </option>
    @endforeach
  </select>

  @error($errorName)
  <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
  </span>
  @enderror
</div>
