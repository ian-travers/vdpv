@php
/** @var \App\Detainer $detainer */
/** @var \App\Wagon $wagon */
@endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="text-center">
      <h3 class="mt-3">Отчет за смену</h3>
      <h4>{{ $shiftStartsAt->format('d.m.Y H:i') }} &mdash; {{ $shiftEndsAt->format('d.m.Y H:i') }}</h4>
    </div>

    <div class="d-flex justify-content-between">
      <div class="w-50 p-3">
        <p class="text-center lead">На начало смены</p>
        <table class="table table-sm table-bordered">
          <tbody>
          <tr class="font-weight-bolder">
            <td width="60%">Задержано всего:<br><span class="small text-muted">в том числе</span></td>
            <td width="20%" class="text-center">{{ App\Wagon::detainedCount(null, $shiftStartsAt) }}</td>
            <td width="20%" class="text-center">{{ App\Wagon::detainedLongCount(null, $shiftStartsAt) }}</td>
          </tr>

          @foreach($detainers as $detainer)
            <tr>
              <td>{{ $detainer->name }}</td>
              <td class="text-center">{{ App\Wagon::detainedCount($detainer, $shiftStartsAt) }}</td>
              <td class="text-center">{{ App\Wagon::detainedLongCount($detainer, $shiftStartsAt) }}</td>
            </tr>

          @endforeach
          </tbody>
        </table>
      </div>
      <div class="w-50 p-3">
        <p class="text-center lead">На конец смены</p>
        <table class="table table-sm table-bordered">
          <tbody>
          <tr class="font-weight-bolder">
            <td width="60%">Задержано всего:<br><span class="small text-muted">в том числе</span></td>
            <td width="20%" class="text-center">{{ App\Wagon::detainedCount(null, $shiftEndsAt) }}</td>
            <td width="20%" class="text-center">{{ App\Wagon::detainedLongCount(null, $shiftEndsAt) }}</td>
          </tr>

          @foreach($detainers as $detainer)
            <tr>
              <td>{{ $detainer->name }}</td>
              <td class="text-center">{{ App\Wagon::detainedCount($detainer, $shiftEndsAt) }}</td>
              <td class="text-center">{{ App\Wagon::detainedLongCount($detainer, $shiftEndsAt) }}</td>
            </tr>

          @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-2">
      <h3 class="text-center">Движение вагонов за смену</h3>
      <table class="table table-sm table-bordered">
        <thead>
        <tr class="text-center">
          <th>#</th>
          <th>Номер вагона</th>
          <th>Прибыл</th>
          <th>Задержан</th>
          <th>Причина</th>
          <th>Выпущен</th>
          <th>Отправлен</th>
        </tr>
        </thead>
        <tbody>

        @forelse($wagons as $wagon)
          <tr>
            <td class="text-center">{{ $loop->index + 1 }}</td>
            <td class="text-center">{{ $wagon->inw }}</td>
            <td class="text-center">{{ $wagon->arrived_at ? $wagon->arrived_at->format('d.m.Y H:i') : '' }}</td>
            <td class="text-center {{ $wagon->isDetainedBetween($shiftStartsAt, $shiftEndsAt) ? 'bg-primary' : '' }}">{{ $wagon->detained_at->format('d.m.Y H:i') }}</td>
            <td>{{ $wagon->reason }}</td>
            <td class="text-center {{ $wagon->isReleasedBetween($shiftStartsAt, $shiftEndsAt) ? 'bg-secondary' : '' }}">{{ $wagon->released_at ? $wagon->released_at->format('d.m.Y H:i') : '' }}</td>
            <td class="text-center {{ $wagon->isDepartedBetween($shiftStartsAt, $shiftEndsAt) ? 'bg-success' : '' }}">{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y H:i') : ''}}</td>
          </tr>
        @empty
          <p>Операций с задержанными вагонами за смену не было.</p>

        @endforelse
        </tbody>
      </table>

    </div>

  </div>
@endsection

