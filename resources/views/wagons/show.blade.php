@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="d-flex mb-4 justify-content-between">
      <div>
        <h2>Информация по вагону {{ $wagon->inw }}</h2>
      </div>
      <div>
        <a class="btn btn-outline-primary" href="{{ route('wagons.index') }}">Список вагонов</a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <table class="table table-sm border border-bottom">
          <tbody>

          @if(!$wagon->isLocal())
            <tr>
              <td width="15%" class="text-right text-muted">Возврат</td>
              <td>{{ $wagon->returning ? 'Да' : 'Нет' }}</td>
            </tr>

          @endif
          <tr>
            <td width="15%" class="text-right text-muted">Прибыл</td>
            <td>{{ $wagon->arrived_at ? $wagon->arrived_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td width="15%" class="text-right text-muted">{{ $wagon->detained_at ? 'Задержан' : 'Категория' }}</td>
            <td><strong>{{ $wagon->detainer->name }}</strong> {{ $wagon->detained_at ? $wagon->detained_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>

          @if(!$wagon->isLocal())
            <tr>
              <td width="15%" class="text-right text-muted">Причина задержки</td>
              <td>{{ $wagon->reason }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Груз</td>
              <td>{{ $wagon->cargo }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Экспедитор по БЧ</td>
              <td>{{ $wagon->forwarder }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Собственность</td>
              <td>{{ $wagon->ownership }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Ст. отправления</td>
              <td>{{ $wagon->departure_station }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Ст. назначения</td>
              <td>{{ $wagon->destination_station }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Принятые меры</td>
              <td>{{ $wagon->taken_measure }}</td>
            </tr>

          @endif

          @if($wagon->isLocal())
            <tr>
              <td width="15%" class="text-right text-muted">Грузовая операция</td>
              <td>{{ $wagon->renderOperation() }}</td>
            </tr>

          @endif
          <tr>
            <td width="15%" class="text-right text-muted">Выпущен</td>
            <td>{{ $wagon->released_at ? $wagon->released_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>

          @if($wagon->isLocal())
            <tr>
              <td width="15%" class="text-right text-muted">Подан</td>
              <td>{{ $wagon->delivered_at ? $wagon->delivered_at->format('d.m.Y в H:i') : '' }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Гр. опер. завершена</td>
              <td>{{ $wagon->cargo_operation_finished_at ? $wagon->cargo_operation_finished_at->format('d.m.Y в H:i') : '' }}</td>
            </tr>
            <tr>
              <td width="15%" class="text-right text-muted">Убран</td>
              <td>{{ $wagon->removed_at ? $wagon->removed_at->format('d.m.Y в H:i') : '' }}</td>
            </tr>

          @endif

          <tr>
            <td width="15%" class="text-right text-muted">Отправлен</td>
            <td>{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y H:i') : ''}}</td>
          </tr>
          </tbody>
        </table>

        <div class="text-right">
          <a class="btn btn-outline-primary mr-2" href="{{ route('wagons.edit', $wagon) }}">Редактировать</a>
          <form action="{{ route('wagons.destroy', $wagon) }}" method="post" class="d-inline">

            @csrf
            @method('delete')
            <button type="submit" onclick="return confirm('Подтверждаете удаление?')" class="btn btn-outline-danger">Удалить</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

