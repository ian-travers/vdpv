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
  <select id="idle_start_event" class="form-control" name="idle_start_event">

    @foreach ($events as $value => $label)
      <option value="{{ $value }}"{{ $value === old('idle_start_event', $detainer->idle_start_event) ? ' selected' : '' }}>{{ $label }}</option>

    @endforeach;
  </select>
</div>