@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start mb-3">
      <h2 class="mb-0">Список задержанных вагонов &#x1F683;</h2>
      <a href="{{ route('wagons.create') }}" class="btn btn-outline-primary">Добавить вагон</a>
    </div>

    @if(count($wagons))
      @include('wagons.table')

      <div class="mt-3">
        {{ $wagons->appends(request()->except('page'))->links() }}
      </div>
    @else
      <p>Задержанных вагонов нет.</p>
    @endif

  </div>
@endsection

