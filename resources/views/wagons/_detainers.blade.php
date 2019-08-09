@foreach($detainers as $detainer)

  <option value="{{ $detainer->id }}"
          @isset($wagon->id)
            @if ($wagon->detainer_id == $detainer->id)
              selected="selected"
            @endif
          @endisset
  >
    {{ $detainer->name }}
  </option>
@endforeach


