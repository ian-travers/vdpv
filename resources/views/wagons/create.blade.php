@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <h1>Добавление вагона</h1>
    <div class="bg-white rounded border border-secondary p-3">
      <h2>Информация по вагону</h2>
      <form action="/wagons" method="post">

        @csrf

        <div class="d-sm-inline-flex justify-content-lg-start align-items-start">
          {{-- Номер вагона --}}
          <div class="form-group mr-2">
            <label for="inw">Инвентарный номер</label>
            <input type="text" id="inw" name="inw" value="{{ old('inw') }}"
                   class="form-control {{ $errors->has('inw') ? 'is-invalid' : '' }}" required autofocus>

            @if($errors->has('inw'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('inw') }}</strong>
              </div>

            @endif
          </div>

          {{-- Организация задержки --}}
          <div class="form-group mr-2">
            <label for="detained_by">Кем задержан</label>
            <input type="text" id="detained_by" name="detained_by" value="{{ old('detained_by') }}"
                   class="form-control {{ $errors->has('detained_by') ? 'is-invalid' : '' }}" required>

            @if($errors->has('detained_by'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('detained_by') }}</strong>
              </div>

            @endif
          </div>

          {{-- Причина задержки --}}
          <div class="form-group mr-2">
            <label for="reason">Причина задержки</label>
            <input type="text" id="reason" name="reason" value="{{ old('reason') }}"
                   class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}">

            @if($errors->has('reason'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('reason') }}</strong>
              </div>

            @endif
          </div>

          {{-- Груз --}}
          <div class="form-group mr-2">
            <label for="cargo">Наименование груза</label>
            <input type="text" id="cargo" name="cargo" value="{{ old('cargo') }}"
                   class="form-control {{ $errors->has('cargo') ? 'is-invalid' : '' }}">

            @if($errors->has('cargo'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('cargo') }}</strong>
              </div>

            @endif
          </div>

          {{-- Экспедитор --}}
          <div class="form-group mr-2">
            <label for="forwarder">Экспедитор по БЧ</label>
            <input type="text" id="forwarder" name="forwarder" value="{{ old('forwarder') }}"
                   class="form-control {{ $errors->has('forwarder') ? 'is-invalid' : '' }}">

            @if($errors->has('forwarder'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('forwarder') }}</strong>
              </div>

            @endif
          </div>

          {{-- Собственность вагона --}}
          <div class="form-group mr-2">
            <label for="ownership">Собственность</label>
            <input type="text" id="ownership" name="ownership" value="{{ old('ownership') }}"
                   class="form-control {{ $errors->has('ownership') ? 'is-invalid' : '' }}">

            @if($errors->has('ownership'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('ownership') }}</strong>
              </div>

            @endif
          </div>
        </div>

        <div class="d-md-inline-flex justify-content-lg-start align-items-start">
          {{-- Станция отправления --}}
          <div class="form-group mr-2">
            <label for="departure_station">Станция отправления</label>
            <input type="text" id="departure_station" name="departure_station" value="{{ old('departure_station') }}"
                   class="form-control {{ $errors->has('departure_station') ? 'is-invalid' : '' }}" required>

            @if($errors->has('departure_station'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('departure_station') }}</strong>
              </div>

            @endif
          </div>

          {{-- Станция назначения --}}
          <div class="form-group mr-2">
            <label for="destination_station">Станция назначения</label>
            <input type="text" id="destination_station" name="destination_station"
                   value="{{ old('destination_station') }}"
                   class="form-control {{ $errors->has('destination_station') ? 'is-invalid' : '' }}" required>

            @if($errors->has('destination_station'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('destination_station') }}</strong>
              </div>

            @endif
          </div>

          {{-- Дата/время прибытия --}}
          <div class="form-group mr-2">
            <label for="arrived_at">Дата/время прибытия</label>
            <input type="datetime-local" id="arrived_at" name="arrived_at"
                   value="{{ old('arrived_at') }}"
                   class="form-control {{ $errors->has('arrived_at') ? 'is-invalid' : '' }}" required>

            @if($errors->has('arrived_at'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('arrived_at') }}</strong>
              </div>

            @endif
          </div>

          {{-- Дата/время задержания --}}
          <div class="form-group mr-2">
            <label for="detained_at">Дата/время задержания</label>
            <input type="datetime-local" id="detained_at" name="detained_at"
                   value="{{ old('detained_at') }}"
                   class="form-control {{ $errors->has('detained_at') ? 'is-invalid' : '' }}" required>

            @if($errors->has('detained_at'))
              <div class="invalid-feedback">
                <strong>{{ $errors->first('detained_at') }}</strong>
              </div>

            @endif
          </div>
        </div>

        <div class="form-group d-flex align-items-end">
          <button type="submit" class="btn btn-outline-primary btn-lg mr-2">Сохранить</button>
          <a href="{{route('wagons.index')}}" class="btn btn-outline-secondary btn-sm">Отменить</a>
        </div>
      </form>
    </div>

  </div>
@endsection


