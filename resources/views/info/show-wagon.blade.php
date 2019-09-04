@php
  /* @var App\Wagon $wagon */
  /* @var App\Wagon $another */
@endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-9">

        <div class="card">
          <div class="card-header bg-light d-flex justify-content-between">
            <div>
              <h3>Информация о вагоне {{ $wagon->inw }}</h3>

              @if($wagon->isHasAnotherDetaining())
                <span class="btn btn-warning btn-sm border border-dark">Внимание! По этому вагону есть еще информация</span>

                @foreach($wagon->getAnotherDetaining() as $another)
                  @if($another->isDetained())
                    <a href="{{ $another->viewPath() }}"
                       class="btn btn-sm btn-primary">Задержан {{ $another->detained_at->format('d.m.Y') }}</a>

                  @endif
                  @if($another->isReleased())
                    <a href="{{ $another->viewPath() }}"
                       class="btn btn-sm btn-secondary">Выпущен {{ $another->released_at->format('d.m.Y') }}</a>

                  @endif
                    @if($another->isDeparted())
                      <a href="{{ $another->viewPath() }}"
                         class="btn btn-sm btn-success">Отправлен {{ $another->departed_at->format('d.m.Y') }}</a>

                    @endif
                @endforeach
              @endif
            </div>

            @can('manage', $wagon)
              <div class="text-right">
                <a class="btn btn-outline-primary mr-2" href="{{ route('wagons.edit', $wagon) }}">Редактировать</a>
              </div>

            @endcan


          </div>
          <div class="card-body">
            <table class="table table-sm border border-bottom">
              <tbody>
              <tr>
                <td width="15%" class="text-right text-muted">Возврат</td>
                <td>{{ $wagon->returning ? 'Да' : 'Нет' }}</td>
              </tr>
              <tr>
                <td width="15%" class="text-right text-muted">Прибыл</td>
                <td>{{ $wagon->arrived_at ? $wagon->arrived_at->format('d.m.Y в H:i') : '' }}</td>
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
                <td width="15%" class="text-right text-muted">Грузовая операция</td>
                <td>{{ $wagon->renderOperation() }}</td>
              </tr>
              <tr>
                <td width="15%" class="text-right text-muted">Парк/Путь &rarr; НПЛФ</td>
                <td>
                  {{ $wagon->park ? $wagon->park . "/" . $wagon->way : '' }}
                  {{ $wagon->nplf ? '- ' . $wagon->nplf : '' }}</td>
              </tr>
              <tr>
                <td width="15%" class="text-right text-muted">Выпущен</td>
                <td>{{ $wagon->released_at ? $wagon->released_at->format('d.m.Y в H:i') : '' }}</td>
              </tr>
              <tr>
                <td width="15%" class="text-right text-muted">Отправлен</td>
                <td>{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y в H:i') : ''}}</td>
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

