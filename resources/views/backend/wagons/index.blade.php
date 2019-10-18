@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-2">

        @include('backend.left-sidebar')
      </div>
      <div class="col-10">
        <div class="card">
          <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-start">
              <h3 class="mb-0">{{ count($term) ? 'Результаты поиска' : 'Управление вагонами' }}</h3>
              <div class="d-flex">
                <form action="{{ route('admin.wagons.index') }}" class="mr-3">
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
                <a href="{{ route('admin.wagons.create') }}" class="btn btn-outline-primary">Добавить вагон</a>
              </div>
            </div>
          </div>

          @if(count($wagons))
            @include('backend.wagons.table')

            <div class="mt-3">
              {{ $wagons->appends(request()->except('page'))->links() }}
            </div>

          @else
            <p class="p-3">Ничего не найдено.</p>

          @endif
        </div>
      </div>
    </div>
  </div>

@endsection


