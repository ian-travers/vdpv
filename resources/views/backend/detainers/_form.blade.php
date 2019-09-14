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
  <label for="idle_start_event" class="col-form-label">Событие для отсчета простоя</label>
  <input type="text" id="idle_start_event" name="idle_start_event" value="{{ old('idle_start_event', $detainer->idle_start_event) }}"
         class="form-control {{ $errors->has('idle_start_event') ? 'is-invalid' : '' }}" >

  @if ($errors->has('idle_start_event'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('idle_start_event') }}</strong>
    </div>

  @endif
</div>