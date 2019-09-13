@php /* @var App\Detainer $detainer */ @endphp

<div class="form-group shadow p-3 mb-3 bg-light rounded-lg required">
  <label for="name">Наименование</label>
  <input type="text" id="name" name="name" value="{{ old('name', $detainer->name) }}"
         class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autofocus>

  @if($errors->has('name'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('name') }}</strong>
    </div>

  @endif
</div>

<div class="form-group shadow p-3 mb-3 bg-light rounded-lg required">
  <label for="long_detain_event" class="col-form-label">Событие для отсчета простоя</label>
  <input type="text" id="long_detain_event" name="long_detain_event" value="{{ old('long_detain_event', $detainer->long_detain_event) }}"
         class="form-control {{ $errors->has('long_detain_event') ? 'is-invalid' : '' }}" >

  @if ($errors->has('long_detain_event'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('long_detain_event') }}</strong>
    </div>

  @endif
</div>