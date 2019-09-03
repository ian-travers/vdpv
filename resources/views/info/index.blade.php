@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')
  <div class="container-fluid">
    <h3 class="mt-3">{{ request('term') !== null ? 'Результаты поиска' : ''}}</h3>
    <div class="row mt-3">
      <div class="col-9">

        @if(!count($wagons))

          @if(request('term'))
            <div class="alert alert-warning border">
              Ничего не найдено по запросу "{{ request('term') }}".
            </div>

          @else
            <div class="widget">
              <div class="widget-heading">
                <h4>
                  Вагоны:
                  <span class="badge badge-primary">задержанные</span>
                  <span class="badge badge-danger">длительно простаивающие</span>
                  <span class="badge badge-secondary">на контроле</span>
                  <a href="{{ route('controlled') }}">
                    <span class="badge badge-secondary float-right">{{ controlledAtCount() }}</span>
                  </a>
                  <a href="{{ route('long-only') }}">
                    <span class="badge badge-danger float-right mr-1">{{ detainedLongAtCount() }}</span>
                  </a>
                  <a href="{{ route('detained') }}">
                    <span class="badge badge-primary float-right mr-1">{{ detainedAtCount() }}</span>
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

                        <a href="{{ route('controlled-by', $detainer) }}">
                          <span
                              class="badge badge-secondary float-right">{{ controlledAtCount($detainer) }}</span>
                        </a>
                        <a href="{{ route('detained-by-long', $detainer) }}">
                          <span
                              class="badge badge-danger float-right mr-1">{{ detainedLongAtCount($detainer) }}</span>
                        </a>

                        @if($detainer->id <> 7)
                          <a href="{{ route('detained-by', $detainer) }}">
                            <span
                                class="badge badge-primary float-right mr-1">
                              {{ detainedAtCount($detainer) }}
                            </span>
                          </a>

                        @endif
                      </div>
                    </li>

                  @endforeach
                </ul>
              </div>
            </div>

            <div class="widget">
              <div class="widget-heading">
                <h4>За последние 10 дней</h4>
              </div>
              <div style="max-height: 200px">
                {!! $lastTenDaysChart->container() !!}
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

@section('script')
  {!! $lastTenDaysChart->script() !!}
@endsection
