@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-9">

        <div class="card">
          <div class="card-header bg-light">
            <h2>Информация о вагоне {{ $wagon->inw }}</h2>
          </div>
          <div class="card-body">
            <table class="table table-sm border border-bottom">
              <tbody>
              <tr>
                <td width="15%" class="text-right text-muted">Прибыл</td>
                <td>{{ $wagon->arrived_at->format('d.m.Y в H:i') }}</td>
              </tr>
              <tr>
                <td width="15%" class="text-right text-muted">Задержан</td>
                <td><strong>{{ $wagon->detainer->name }}</strong> {{ $wagon->detained_at->format('d.m.Y в H:i') }}</td>
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
        </div>

      </div>
      <div class="col-3">

        @include('info.sidebar')
      </div>
    </div>
  </div>


@endsection

