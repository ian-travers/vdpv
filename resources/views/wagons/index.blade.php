@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-end">
      <h1>Список задержанных вагонов</h1>
      <a href="{{ route('wagons.create') }}" class="btn btn-outline-primary">Добавить вагон</a>
    </div>

    @forelse($wagons as $wagon)
      <ul>
        <li>
          <a href="{{ $wagon->path() }}">{{ $wagon->inw }}</a>
        </li>
      </ul>
    @empty
      <p>Пока нет ни одного вагона.</p>
    @endforelse
  </div>
@endsection

