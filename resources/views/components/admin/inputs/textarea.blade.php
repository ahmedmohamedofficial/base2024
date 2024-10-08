<div class="mb-3">
    @if(!empty($label))
        <label for="input-{{ $name }}">{{ $label }}</label>
    @endif
    @if($disabled)
        <div class="{{ $className }} h-auto">{{ $value }}</div>
    @else
        <textarea class="{{ $className }}" name="{{ $name }}" {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }} id="{{ $idName ?? 'textarea-' . $name }}" cols="{{ $cols }}" rows="{{ $rows }}" placeholder="{{ $placeholder }}">{{ $value }}</textarea>
    @endif
    @if(!empty($validMessage))
            <div class="valid-feedback">{{ $validMessage }}</div>
    @endif
    @if(!empty($inValidMessage))
            <div class="invalid-feedback error_{{ $name }}">{{ $inValidMessage }}</div>
    @endif

</div>
