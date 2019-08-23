@php
  /** @var \App\Detainer $detainer */
  /** @var \App\Wagon $wagon */
@endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="text-center">
      <h3 class="mt-3">Отчет на {{ $atTime->format('H:i d.m.Y') }}</h3>
    </div>

    <div class="d-flex justify-content-center">
      <div class="w-75 p-3">
        <p class="text-center lead"></p>
        <table class="table table-sm table-bordered">
          <tbody>
          <tr class="font-weight-bolder">
            <td width="60%">Задержано: всего/длительно простаивающих<br><span class="small text-muted">в том числе:</span></td>
            <td width="20%" class="text-center">
              {{ detainedAtCount(null, $atTime) }}
            </td>
            <td width="20%" class="text-center">
              {{ detainedLongAtCount(null, $atTime) }}
            </td>
          </tr>

          @foreach($detainers as $detainer)
            <tr>
              <td>{{ $detainer->name }}</td>
              <td class="text-center">
                {{ detainedAtCount($detainer, $atTime) }}
              </td>
              <td class="text-center">
                {{ detainedLongAtCount($detainer, $atTime) }}
              </td>
            </tr>

          @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-2">
      <h3 class="text-center">Задержанные вагоны</h3>

      @if($wagons->count())
        <table class="table table-sm table-bordered">
          <thead>
          <tr class="text-center">
            <th>#</th>
            <th>Номер вагона</th>
            <th>Прибыл</th>
            <th>Задержан</th>
            <th>Причина</th>
            <th>Отправлен</th>
          </tr>
          </thead>
          <tbody>

          @foreach($wagons as $wagon)
            <tr>
              <td class="text-center">{{ $loop->index + 1 }}</td>
              <td class="text-center">
                <a href="{{ route('show-wagon', $wagon) }}">{{ $wagon->inw }}</a>

              </td>
              <td class="text-center">{{ $wagon->arrived_at ? $wagon->arrived_at->format('d.m.Y H:i') : '' }}</td>
              <td class="text-center">{{ $wagon->detained_at->format('d.m.Y H:i') }}</td>
              <td>{{ $wagon->reason }}</td>
              <td class="text-center">{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y H:i') : ''}}</td>
            </tr>

          @endforeach
          </tbody>
        </table>

      @else
        <p class="lead ml-3">Задержанные вагоны отсутствуют!</p>

      @endif
    </div>

  </div>
@endsection
