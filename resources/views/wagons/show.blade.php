@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="d-flex mb-4 justify-content-between">
      <div>
        <h3>Информация по вагону</h3>
      </div>
      <div>
        <a class="btn btn-outline-primary mr-2" href="/wagons/{{ $wagon->path() }}/edit">Редактировать</a>
        <a class="btn btn-outline-success mr-2" href="/wagons/{{ $wagon->path() }}/release">Выпустить</a>
        <a class="btn btn-outline-danger mr-2" href="/wagons/{{ $wagon->path() }}/delete">Удалить</a>
      </div>
    </div>
    <table class="table">
      <tbody>
      <tr>
        <td width="15%" class="text-right text-muted">Номер</td>
        <td>{{ $wagon->inw }}</td>
      </tr>
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
        <td width="15%" class="text-right text-muted">Прибыл</td>
        <td>{{ $wagon->arrived_at }}</td>
      </tr>
      <tr>
        <td width="15%" class="text-right text-muted">Задержан</td>
        <td>{{ $wagon->detained_at }}</td>
      </tr>
      <tr>
        <td width="15%" class="text-right text-muted">Принятые меры</td>
        <td>{{ $wagon->taken_measure }}</td>
      </tr>
      <tr>
        <td width="15%" class="text-right text-muted">Выпущен</td>
        <td>{{ $wagon->released_at }}</td>
      </tr>
      <tr>
        <td width="15%" class="text-right text-muted">Отправлен</td>
        <td>{{ $wagon->departed_at }}</td>
      </tr>
      </tbody>
    </table>
  </div>
@endsection

