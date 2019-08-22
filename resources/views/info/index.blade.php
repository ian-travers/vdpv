@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')
  <div class="container-fluid">
    <h3 class="mt-3">{{ request('term') !== null ? 'Результаты поиска' : ''}}</h3>
    <div class="row mt-3">
      <div class="col-9">

        @if(!count($wagons))

          @if(request('term'))
            <div class="alert alert-warning">
              Ничего не найдено по запросу "{{ request('term') }}"!
            </div>

          @else
            <div class="widget">
              <div class="widget-heading">
                <h4>
                  Задержано: всего/длительно простаивающих
                  <a href="{{ route('long-only') }}">
                    <span class="badge badge-danger float-right">{{ App\Wagon::detainedLongCount() }}</span>
                  </a>
                  <a href="{{ route('all') }}">
                    <span class="badge badge-primary float-right mr-1">{{ App\Wagon::detainedCount() }}</span>
                  </a>
                </h4>
              </div>
              <div class="widget-body">
                <ul class="categories">

                  @foreach($detainers as $detainer)
                    <li>
                      <div>
                        <a href="{{ route('detained-by', $detainer) }}">
                          {{ $detainer->name }}
                        </a>

                        <a href="{{ route('detained-by-long', $detainer) }}">
                          <span
                              class="badge badge-danger float-right">{{ App\Wagon::detainedLongCount($detainer) }}</span>
                        </a>

                        <a href="{{ route('detained-by', $detainer) }}">
                      <span
                          class="badge badge-primary float-right mr-1">{{ App\Wagon::detainedCount($detainer) }}</span>
                        </a>
                      </div>
                    </li>

                  @endforeach
                </ul>
              </div>
            </div>

          @endif
        @else
          @include('info.wagons-table')
          <nav>
            {{ $wagons->appends(request()->only(['term']))->links() }}
          </nav>

        @endif


      </div>
      <div class="col-3">

        @include('info.sidebar')
      </div>
    </div>
  </div>
@endsection

