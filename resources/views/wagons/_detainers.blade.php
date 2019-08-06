@foreach($detainers as $key => $value)

  <option value="{{ $key }}"
          @isset($wagon->id)
            @if ($wagon->detained_by == $key)
              selected="selected"
            @endif
          @endisset
  >
    {{ $value }}
  </option>
@endforeach


