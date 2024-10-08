<div class="mb-3">
    @if(!empty($label))
        <label for="{{ $idName ? $idName :  'select-' . $name }}">{{ $label }}</label>
    @endif
    @if($disabled)
        @if($multiple)
            <div class="{{ $className }} h-auto">
                {{ $multiplesValues }}
            </div>
        @else
            <div class="{{ $className }} h-auto">{{ $value }}</div>
        @endif
    @else
        <select name="{{ $name }}" {{ $multiple ? 'multiple' : '' }} class="{{ $className }}" {{ $required ? 'required' : '' }}  @foreach($parameters as $key => $parameter) '{{ "$key" . '=' . "$parameter" }}'@endforeach id="{{ $idName ?$idName :  'select-' . $name }}"  data-placeholder="{{ $placeholder }}" data-allow-clear="true" >
            {{ $options }}
        </select>
    @endif

    @if(!empty($validMessage))
            <div class="valid-feedback">{{ $validMessage }}</div>
    @endif
    @if(!empty($inValidMessage))
            <div class="invalid-feedback error_{{ $name }}">{{ $inValidMessage }}</div>
    @endif
</div>
