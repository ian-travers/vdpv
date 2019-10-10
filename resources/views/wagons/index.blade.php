@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="d-flex justify-content-between align-items-start mb-3">
      <h2 class="mb-0">{{ count($term) ? 'Результаты поиска' : 'Список задержанных и/или местных вагонов' }}</h2>
      <div class="d-flex">
        <form action="{{ route('wagons.index') }}" class="mr-3">
          <div class="input-group">
            <input type="text" class="form-control" value="{{ request('term') }}" name="term"
                   placeholder="Поиск вагона..." autofocus>
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div><!-- /input-group -->
        </form>
        <a href="{{ route('wagons.create') }}" class="btn btn-outline-primary">Добавить вагон</a>
      </div>
    </div>

    @if(count($wagons))
      @include('wagons.table')

      <div class="mt-3">
        {{ $wagons->appends(request()->except('page'))->links() }}
      </div>
    @else
      <p>Ничего не найдено.</p>
    @endif

  </div>
@endsection

