@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start border-bottom mb-2">
      <h2>Список задержанных вагонов</h2>
      <a href="{{ route('wagons.create') }}" class="btn btn-outline-primary">Добавить вагон</a>
    </div>

    @if(count($wagons))
      @include('wagons.table')
    @else
      <p>Задержанных вагонов нет.</p>
    @endif

  </div>
@endsection

