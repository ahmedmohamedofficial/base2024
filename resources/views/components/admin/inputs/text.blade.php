<div class="mb-3">
    @if(!empty($label))
        <label for="input-{{ $name }}">{{ $label }}</label>
    @endif
    @if($disabled)
        <div class="{{ $className }} h-auto">{{ $value }}</div>
    @else
        <input type="{{ $type }}" class="{{ $className }}" {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }} @foreach($parameters as $key => $parameter) {{ $key . '=' . $parameter }} @endforeach name="{{ $name }}" id="{{ $idName ?? 'input-' . $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}">
    @endif

    @if(!empty($validMessage))
            <div class="valid-feedback">{{ $validMessage }}</div>
    @endif
    @if(!empty($inValidMessage))
            <div class="invalid-feedback error_{{ $name }}">{{ $inValidMessage }}</div>
    @endif
</div>
