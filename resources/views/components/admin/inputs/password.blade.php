<div class="mb-3">
    <div class="form-password-toggle">
        @if(!empty($label))
            <label for="input-{{ $name }}">{{ $label }}</label>
        @endif
        <div class="input-group">
            <input
                    type="password"
                    class="{{ $className }}"
                    id="input-{{ $name }}"
                    {{ $required ? 'required' : '' }}
                    value="{{ $value }}"
                    @foreach($parameters as $key => $parameter) '{{ "$key" . '=' . "$parameter" }}' @endforeach name="{{ $name }}"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password-{{ $name }}" />
            <span id="password-{{ $name }}" class="input-group-text cursor-pointer"
            ><i class="ti ti-eye-off"></i
                ></span>
        </div>
    </div>


    @if(!empty($validMessage))
        <div class="valid-feedback">{{ $validMessage }}</div>
    @endif
    @if(!empty($inValidMessage))
        <div class="invalid-feedback error_{{ $name }}">{{ $inValidMessage }}</div>
    @endif
</div>
