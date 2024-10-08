<div class="imgMontg col-12 text-center">
    <div class="dropBox">
        <div class="textCenter">
            <div class="imagesUploadBlock">
                <label class="uploadImg" for="image-{{ $name }}">
                    <span><i class="fa fa-image"></i></span>
                    <input type="file" accept="image/*"  {{ $required ? 'required' : '' }} {{ $disabled ? 'disabled' : '' }} @foreach($parameters as $key => $parameter) {{ $key . '=' . $parameter }} @endforeach  name="{{ $name }}" id="image-{{ $name }}" class="imageUploader">
                </label>
                @if($src)
                    <div class="uploadedBlock">
                        <img src="{{ $src }}">
                        @if(!$disabled)
                            <button type="button" class="close"><i class="fa fa-times"></i></button>
                        @endif
                    </div>
                @endif

            </div>
            @if(!empty($validMessage))
                <div class="valid-feedback">{{ $validMessage }}</div>
            @endif
            @if(!empty($inValidMessage))
                <div class="invalid-feedback error_{{ $name }}">{{ $inValidMessage }}</div>
            @endif
            <span>{{ $desc }}</span>
        </div>
    </div>
</div>


