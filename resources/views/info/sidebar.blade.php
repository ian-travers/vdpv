@php /* @var App\Detainer $detainer */ @endphp

<aside>
  <div class="search-widget">

    <form action="{{ route('root') }}">
      <div class="input-group input-group-lg">
        <input type="text" class="form-control" value="{{ request('term') }}" name="term"
               placeholder="Поиск...">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div><!-- /input-group -->
    </form>

  </div>

  <div class="widget">
    <div class="widget-heading">
      <h4>
        Задержано вагонов
        <span class="badge badge-warning float-right">{{ App\Wagon::detainedLongCount() }}</span>
        <span class="badge badge-secondary float-right mr-1">{{ App\Wagon::detainedAllCount() }}</span>
      </h4>
    </div>
    <div class="widget-body">
      <ul class="categories">

        @foreach($detainers as $detainer)
          <li>
            <div>
              <a href="{{ route('detained-by', $detainer->name) }}">{{ $detainer->name }}</a>
              <span class="badge badge-warning float-right">{{ App\Wagon::detainedLongCount($detainer) }}</span>
              <span class="badge badge-secondary float-right mr-1">{{ $detainer->wagons->count() }}</span>
            </div>

          </li>

        @endforeach

      </ul>
    </div>
  </div>
</aside>

