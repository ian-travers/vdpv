@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-2">

        @include('backend.left-sidebar')
      </div>
      <div class="col-10">
        <div class="card">
          <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h2 class="d-inline">Просмотр информации по вагону: {{ $wagon->inw }}</h2>
                <a class="btn btn-outline-primary mx-2 mt-n2" href="{{ route('admin.wagons.edit', $wagon) }}">Редактировать</a>
                <form action="{{ route('admin.wagons.destroy', $wagon) }}" method="post" class="d-inline">

                  @csrf
                  @method('delete')
                  <button type="submit" onclick="return confirm('Подтверждаете удаление?')" class="btn btn-outline-danger mt-n2">Удалить</button>
                </form>
              </div>
              <a class="btn btn-outline-primary" href="{{ route('admin.wagons.index') }}">Вагоны</a>
            </div>
          </div>
        </div>
        <table class="table table-sm border border-bottom">
          <tbody>
          <tr>
            <td colspan="2" class="text-center text-warning bg-secondary">Служебная информация</td>
          </tr>
          <tr>
            <td width="20%" class="text-right text-muted">ID</td>
            <td class="italic">{{ $wagon->id }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Создатель записи (ID)</td>
            <td class="italic">{{ $wagon->creator->name }} ({{ $wagon->creator->id }})</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Создано</td>
            <td class="italic">{{ $wagon->created_at ? $wagon->created_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Изменено</td>
            <td class="italic">{{ $wagon->updated_at ? $wagon->updated_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td colspan="2" class="text-center text-warning bg-secondary">Основная информация</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Номер</td>
            <td>{{ $wagon->inw }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Возврат</td>
            <td>{{ $wagon->returning ? 'Да' : 'Нет' }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Прибыл</td>
            <td>{{ $wagon->arrived_at ? $wagon->arrived_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Задержан</td>
            <td>{{ $wagon->detained_at ? $wagon->detained_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Причина задержания</td>
            <td>{{ $wagon->reason }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Кем задержан или категория</td>
            <td>{{ $wagon->detainer->name }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Станция отправления</td>
            <td>{{ $wagon->departure_station }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Станция назначения</td>
            <td>{{ $wagon->destination_station }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Наименованние груза</td>
            <td>{{ $wagon->cargo }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Экспедитор по БЧ</td>
            <td>{{ $wagon->forwarder }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Собственность</td>
            <td>{{ $wagon->ownership }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Принятые меры</td>
            <td>{{ $wagon->taken_measure }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Выпущен (освобожден)</td>
            <td>{{ $wagon->released_at ? $wagon->released_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Отправлен</td>
            <td>{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td colspan="2" class="text-center text-warning bg-secondary">Дополнительная информация для местного
              вагона
            </td>
          </tr>
          <tr>
            <td class="text-right text-muted">Подан</td>
            <td>{{ $wagon->delivered_at ? $wagon->delivered_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Грузовая операция</td>
            <td>{{ $wagon->renderOperation() }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Завершение грузовой операции</td>
            <td>{{ $wagon->cargo_operation_finished_at ? $wagon->cargo_operation_finished_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          <tr>
            <td class="text-right text-muted">Убран</td>
            <td>{{ $wagon->removed_at ? $wagon->removed_at->format('d.m.Y в H:i') : '' }}</td>
          </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>
@endsection
