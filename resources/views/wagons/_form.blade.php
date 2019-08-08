@php /* @var App\Wagon $wagon */ @endphp

@csrf
<div class="card border border-primary rounded-lg mb-2">
  <div class="card-header bg-primary text-light lead py-1">
    Информация по вагону
  </div>
  <div class="card-body pb-0">
    <div class="d-sm-inline-flex justify-content-lg-start align-items-start">
      {{-- Номер вагона --}}
      <div class="form-group mr-2">
        <label for="inw">Инвентарный номер</label>
        <input type="text" id="inw" name="inw" value="{{ old('inw', $wagon->inw) }}"
               class="form-control {{ $errors->has('inw') ? 'is-invalid' : '' }}" autofocus>

        @if($errors->has('inw'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('inw') }}</strong>
          </div>

        @endif
      </div>

      {{-- Организация задержки --}}
      <div class="form-group mr-2">
        <label for="detained_by">Кем задержан</label>
        <select id="detained_by" name="detained_by"
                class="form-control {{ $errors->has('detained_by') ? 'is-invalid' : '' }}"
                required
        >@include('wagons._detainers')</select>

        @if($errors->has('detained_by'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('detained_by') }}</strong>
          </div>

        @endif
      </div>

      {{-- Причина задержки --}}
      <div class="form-group mr-2">
        <label for="reason">Причина задержки</label>
        <input type="text" id="reason" name="reason" value="{{ old('reason', $wagon->reason) }}"
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
        <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $wagon->cargo) }}"
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
        <input type="text" id="forwarder" name="forwarder" value="{{ old('forwarder', $wagon->forwarder) }}"
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
        <input type="text" id="ownership" name="ownership" value="{{ old('ownership', $wagon->ownership) }}"
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
        <input type="text" id="departure_station" name="departure_station"
               value="{{ old('departure_station', $wagon->departure_station) }}"
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
               value="{{ old('destination_station', $wagon->destination_station) }}"
               class="form-control {{ $errors->has('destination_station') ? 'is-invalid' : '' }}" required>

        @if($errors->has('destination_station'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('destination_station') }}</strong>
          </div>

        @endif
      </div>

      {{-- Дата/время прибытия --}}
      <div class="form-group mr-2">
        <label for="dtp_arrived_at">Дата/время прибытия</label>
        <div class="input-group" id="arrived_at" data-target-input="nearest">
          <input type="text" id="dtp_arrived_at"
                 name="arrived_at"
                 class="form-control datetimepicker-input {{ $errors->has('arrived_at') ? 'is-invalid' : '' }}"
                 data-target="#arrived_at"
                 required
          />
          <div class="input-group-append" data-target="#arrived_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>

        @if($errors->has('arrived_at'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('arrived_at') }}</strong>
          </div>

        @endif
      </div>

      {{-- Дата/время задержания --}}
      <div class="form-group mr-2">
        <label for="dtp_detained_at">Дата/время задержки</label>
        <div class="input-group" id="detained_at" data-target-input="nearest">
          <input type="text" id="dtp_detained_at"
                 name="detained_at"
                 class="form-control datetimepicker-input {{ $errors->has('detained_at') ? 'is-invalid' : '' }}"
                 data-target="#detained_at"
                 required
          />
          <div class="input-group-append" data-target="#detained_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>

        @if($errors->has('detained_at'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('detained_at') }}</strong>
          </div>

        @endif
      </div>

    </div>
  </div>
</div>

<div class="card border border-primary rounded-lg mb-2">
  <div class="card-header bg-primary text-light lead py-1">
    Принятые меры
  </div>
  <div class="d-block">
    <div class="form-group m-0 p-0">
      <textarea id="taken_measure" name="taken_measure" rows="3"
                class="form-control" title="">{{ old('taken_measure', $wagon->taken_measure) }}</textarea>

      @if($errors->has('taken_measure'))
        <div class="invalid-feedback">
          <strong>{{ $errors->first('taken_measure') }}</strong>
        </div>

      @endif
    </div>
  </div>
</div>

<div class="card border border-primary rounded-lg mb-2">
  <div class="card-header bg-primary text-light lead py-1">
    Выпуск вагона
  </div>
  <div class="card-body pb-0">
    <div class="d-inline-flex align-items-end justify-content-end">

      <div class="form-group mr-2">
        <label for="dtp_released_at">Дата/время выпуска</label>
        <div class="input-group" id="released_at" data-target-input="nearest">
          <input type="text" id="dtp_released_at"
                 name="released_at"
                 class="form-control datetimepicker-input {{ $errors->has('released_at') ? 'is-invalid' : '' }}"
                 data-target="#released_at"
          />
          <div class="input-group-append" data-target="#released_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>

        @if($errors->has('released_at'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('released_at') }}</strong>
          </div>

        @endif
      </div>

      <div class="form-group mr-2">
        <label for="dtp_departed_at">Дата/время отправления</label>
        <div class="input-group" id="departed_at" data-target-input="nearest">
          <input type="text" id="dtp_departed_at"
                 name="departed_at"
                 class="form-control datetimepicker-input {{ $errors->has('departed_at') ? 'is-invalid' : '' }}"
                 data-target="#departed_at"
          />
          <div class="input-group-append" data-target="#departed_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>

        @if($errors->has('departed_at'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('departed_at') }}</strong>
          </div>

        @endif
      </div>
    </div>
  </div>
</div>


<div class="form-group d-flex align-items-end">
  <button type="submit" class="btn btn-outline-primary btn-lg mr-2">Сохранить</button>
  <a href="{{route('wagons.index')}}" class="btn btn-outline-secondary btn-sm">Отменить</a>
</div>

@section('script')
  <script type="text/javascript">
    let arrived_at = moment("{{ old('arrived_at', $wagon->arrived_at) }}").toDate();
    let detained_at = moment("{{ old('detained_at', $wagon->detained_at) }}").toDate();
    let released_at = moment("{{ old('released_at', $wagon->released_at) }}").toDate();
    let departed_at = moment("{{ old('departed_at', $wagon->departed_at) }}").toDate();

    $('#arrived_at').datetimepicker({date: arrived_at});
    $('#detained_at').datetimepicker({date: detained_at});
    $('#released_at').datetimepicker({date: released_at});
    $('#departed_at').datetimepicker({date: departed_at});
  </script>
@endsection

