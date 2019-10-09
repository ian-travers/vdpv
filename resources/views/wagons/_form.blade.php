@php /* @var App\Wagon $wagon */ @endphp

@csrf
<div class="card mb-2">
  <div class="card-header bg-primary text-light lead">
    Основная информация по вагону
  </div>
  <div class="card-body">
    <div class="d-inline-flex justify-content-start align-items-start">

      {{--Номер вагона--}}
      <div class="form-group mr-2">
        <label for="inw">Инвентарный номер</label>
        <input type="text" id="inw" name="inw" value="{{ old('inw', $wagon->inw) }}"
               class="form-control {{ $errors->has('inw') ? 'is-invalid' : '' }}" autofocus required>

        @if($errors->has('inw'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('inw') }}</strong>
          </div>

        @endif
      </div>

      {{-- Организация задержки или категория --}}
      <div class="form-group mr-2">
        <label for="detainer_id">Кем задержан / категория</label>
        <select id="detainer_id" name="detainer_id"
                class="form-control {{ $errors->has('detainer_id') ? 'is-invalid' : '' }}"
                required
        >@include('wagons._detainers')</select>

        @if($errors->has('detainer_id'))
          <div class="invalid-feedback">
            <strong>{{ $errors->first('detainer_id') }}</strong>
          </div>

        @endif
      </div>

      {{-- Причина задержки --}}
      <div id="reason-fg" class="form-group mr-2">
        <label for="reason">Причина задержания</label>
        <input type="text" id="reason" name="reason" value="{{ old('reason', $wagon->reason) }}"
               class="form-control {{ $errors->has('reason') ? 'is-invalid' : '' }}"
               size="48" maxlength="250">

      </div>

      {{-- Дата/время прибытия --}}
      <div class="form-group mr-2">
        <label for="dtp_arrived_at">Дата/время прибытия</label>
        <div class="input-group" id="arrived_at" data-target-input="nearest">
          <input type="text" id="dtp_arrived_at"
                 name="arrived_at"
                 class="form-control datetimepicker-input {{ $errors->has('arrived_at') ? 'is-invalid' : '' }}"
                 data-target="#arrived_at"
          />
          <div class="input-group-append" data-target="#arrived_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>

      {{-- Дата/время задержания --}}
      <div class="form-group mr-2">
        <label id="detained_at_label" for="dtp_detained_at">Дата/время задержания</label>
        <div class="input-group" id="detained_at" data-target-input="nearest">
          <input type="text" id="dtp_detained_at"
                 name="detained_at"
                 class="form-control datetimepicker-input {{ $errors->has('detained_at') ? 'is-invalid' : '' }}"
                 data-target="#detained_at"
          />
          <div class="input-group-append" data-target="#detained_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{--Блок для местного вагона--}}
<div id="local-block" class="card mb-2">
  <div class="card-header bg-primary text-light lead">
    Дополнительная информация по местному вагону
  </div>
  <div class="card-body">
    <div class="d-inline-flex justify-content-start align-items-start">
      {{-- Грузовая операция --}}
      <div class="form-group mr-2">
        <label for="operation">Операция</label>
        <select id="operation" name="operation"
                class="form-control {{ $errors->has('operation') ? 'is-invalid' : '' }}">
          <option value=""></option>
          <option
              value="loading"

              @if($wagon->operation == 'loading')
              selected="selected"
              @endif
          >Погрузка
          </option>
          <option
              value="unloading"

              @if($wagon->operation == 'unloading')
              selected="selected"
              @endif
          >Выгрузка
          </option>
        </select>
      </div>

      {{-- Дата/время подачи --}}
      <div class="form-group mr-2">
        <label id="delivered_at_label" for="dtp_delivered_at">Дата/время подачи</label>
        <div class="input-group" id="delivered_at" data-target-input="nearest">
          <input type="text" id="dtp_delivered_at"
                 name="delivered_at"
                 class="form-control datetimepicker-input {{ $errors->has('delivered_at') ? 'is-invalid' : '' }}"
                 data-target="#delivered_at"
          />
          <div class="input-group-append" data-target="#delivered_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>

      {{-- Дата/время окончания грузовой операции --}}
      <div class="form-group mr-2">
        <label id="cargo_operation_finished_at_label" for="dtp_cargo_operation_finished_at">Дата/время окончания гр.
          операции</label>
        <div class="input-group" id="cargo_operation_finished_at" data-target-input="nearest">
          <input type="text" id="dtp_cargo_operation_finished_at"
                 name="cargo_operation_finished_at"
                 class="form-control datetimepicker-input {{ $errors->has('cargo_operation_finished_at') ? 'is-invalid' : '' }}"
                 data-target="#cargo_operation_finished_at"
          />
          <div class="input-group-append" data-target="#cargo_operation_finished_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>

      {{-- Дата/время уборки --}}
      <div class="form-group mr-2">
        <label id="removed_at_label" for="dtp_removed_at">Дата/время уборки</label>
        <div class="input-group" id="removed_at" data-target-input="nearest">
          <input type="text" id="dtp_removed_at"
                 name="removed_at"
                 class="form-control datetimepicker-input {{ $errors->has('removed_at') ? 'is-invalid' : '' }}"
                 data-target="#removed_at"
          />
          <div class="input-group-append" data-target="#removed_at" data-toggle="datetimepicker">
            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

{{--Блок для не местного вагона--}}
<div id="not-local-block" class="card mb-2">
  <div class="card-header bg-primary text-light lead">
    Дополнительная информация по вагону
  </div>
  <div class="card-body">
    <div class="d-inline-flex justify-content-start align-items-start">

      {{-- Груз --}}
      <div id="cargo-fg" class="form-group mr-2">
        <label for="cargo">Наименование груза</label>
        <input type="text" id="cargo" name="cargo" value="{{ old('cargo', $wagon->cargo) }}"
               class="form-control {{ $errors->has('cargo') ? 'is-invalid' : '' }}" maxlength="250">
      </div>

      {{-- Экспедитор --}}
      <div id="forwarder-fg" class="form-group mr-2">
        <label for="forwarder">Экспедитор по БЧ</label>
        <input type="text" id="forwarder" name="forwarder" value="{{ old('forwarder', $wagon->forwarder) }}"
               class="form-control {{ $errors->has('forwarder') ? 'is-invalid' : '' }}" maxlength="250">
      </div>

      {{-- Собственность вагона --}}
      <div id="ownership-fg" class="form-group mr-2">
        <label for="ownership">Собственность</label>
        <input type="text" id="ownership" name="ownership" value="{{ old('ownership', $wagon->ownership) }}"
               class="form-control {{ $errors->has('ownership') ? 'is-invalid' : '' }}" maxlength="250">
      </div>

      {{-- Станция отправления --}}
      <div id="departure_station-fg" class="form-group mr-2">
        <label for="departure_station">Станция отправления</label>
        <input type="text" id="departure_station" name="departure_station"
               value="{{ old('departure_station', $wagon->departure_station) }}"
               class="form-control {{ $errors->has('departure_station') ? 'is-invalid' : '' }}" maxlength="250">
      </div>

      {{-- Станция назначения --}}
      <div class="form-group mr-2">
        <label for="destination_station">Станция назначения</label>
        <input type="text" id="destination_station" name="destination_station"
               value="{{ old('destination_station', $wagon->destination_station) }}"
               class="form-control {{ $errors->has('destination_station') ? 'is-invalid' : '' }}" maxlength="250">
      </div>

      {{-- Признак возврата --}}
      <div id="returning-fg" class="form-group">
        <label for="returning">Возврат</label>
        <input type="checkbox" id="returning" name="returning"
               @if($wagon->returning)
               checked="checked"
               @endif
               class="form-control">
      </div>

    </div>
  </div>
  <div class="d-block mx-3 mb-3 mt-n4">
    <label for="taken_measure">Принятые меры</label>
    <textarea id="taken_measure" name="taken_measure" rows="2"
              class="form-control" title="">{{ old('taken_measure', $wagon->taken_measure) }}</textarea>
  </div>
</div>

<div class="card mb-2">
  <div class="card-header bg-primary text-light lead">
    Окончание задержки и отправление вагона
  </div>
  <div class="card-body">
    <div class="d-inline-flex align-items-end justify-content-end">

      <div id="released_at-fg" class="form-group mr-2">
        <label id="released_at_label" for="dtp_released_at">Дата/время выпуска</label>
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
      </div>

      <div class="form-group">
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
      </div>

    </div>
  </div>
</div>

<div class="form-group d-flex align-items-end">
  <button type="submit" class="btn btn-outline-primary btn-lg mr-2">Сохранить</button>
  <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-outline-secondary btn-sm">Отменить</a>
</div>

@section('script')
  <script type="text/javascript">
      let arrived_at = moment("{{ $wagon->arrived_at }}").toDate();
      let detained_at = moment("{{ $wagon->detained_at }}").toDate();
      let released_at = moment("{{ $wagon->released_at }}").toDate();
      let departed_at = moment("{{ $wagon->departed_at }}").toDate();
      let delivered_at = moment("{{ $wagon->delivered_at }}").toDate();
      let cargo_operation_finished_at = moment("{{ $wagon->cargo_operation_finished_at }}").toDate();
      let removed_at = moment("{{ $wagon->removed_at }}").toDate();

      $('#arrived_at').datetimepicker({date: arrived_at});
      $('#detained_at').datetimepicker({date: detained_at});
      $('#released_at').datetimepicker({date: released_at});
      $('#departed_at').datetimepicker({date: departed_at});
      $('#delivered_at').datetimepicker({date: delivered_at});
      $('#cargo_operation_finished_at').datetimepicker({date: cargo_operation_finished_at});
      $('#removed_at').datetimepicker({date: removed_at});
  </script>
  <script type="text/javascript">
      if (String($('#detainer_id').val()) === String(7)) {
          $('#not-local-block').hide();
          // if (String($('#reason').val()) === '') {
          //     $('#reason').val('Для таможенного оформления');
          // }
      } else {
          $('#local-block').hide();
      }

      $(document).ready(function () {
          $('#detainer_id').change(function () {
              if (String(this.value) === String(7)) {
                  // if (String($('#reason').val()) === '') {
                  //     $('#reason').val('Для таможенного оформления');
                  // }
                  $('#local-block').show(300);
                  $('#not-local-block').hide(300);
              } else {
                  // if (String($('#reason').val()) === 'Для таможенного оформления') {
                      <!--$('#reason').val('{{ $wagon->reason }}');-->
                  // }
                  $('#local-block').hide(300);
                  $('#not-local-block').show(300);
              }
          });
      });
  </script>
@endsection

