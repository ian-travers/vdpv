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
        <span class="badge badge-secondary float-right mr-1">{{ App\Wagon::detainedCount() }}</span>
      </h4>
    </div>
    <div class="widget-body">
      <ul class="categories">

        @foreach($detainers as $detainer)
          @if($detainer->wagons->count())
            <li>
              <div>
                <a href="{{ route('detained-by', $detainer) }}">{{ $detainer->name }}</a>
                <span class="badge badge-warning float-right">{{ App\Wagon::detainedLongCount($detainer) }}</span>
                <span class="badge badge-secondary float-right mr-1">{{ App\Wagon::detainedCount($detainer) }}</span>
              </div>
            </li>

          @endif
        @endforeach

      </ul>
    </div>
  </div>

  <div class="widget">
    <div class="widget-heading">
      <h4>Последние изменения</h4>
    </div>
    <div class="widget-body mb-3">
      <p class="text-center lead">Сегодня {{ Carbon\Carbon::now()->format('d.m.Y') }} г.</p>
      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Задержано</div>
        <div><span class="badge badge-secondary">{{ $curDayDetainedCount }}</span></div>
      </div>
      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Выпущено</div>
        <div><span class="badge badge-primary">{{ $curDayReleasedCount }}</span></div>
      </div>
      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Отправлено</div>
        <div><span class="badge badge-success">{{ $curDayDepartedCount }}</span></div>
      </div>
    </div>

    <p class="text-center lead">Вчера {{ Carbon\Carbon::parse('-1 day')->format('d.m.Y') }} г.</p>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Задержано</div>
      <div><span class="badge badge-secondary">{{ $prevDayDetainedCount }}</span></div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Выпущено</div>
      <div><span class="badge badge-primary">{{ $prevDayReleasedCount }}</span></div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3 mb-2">
      <div>Отправлено</div>
      <div><span class="badge badge-success">{{ $prevDayDepartedCount }}</span></div>
    </div>
  </div>
</aside>

