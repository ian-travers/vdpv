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
        <a href="{{ route('long-only') }}">
          <span class="badge badge-warning float-right">{{ App\Wagon::detainedLongCount() }}</span>
        </a>
        <a href="{{ route('root') }}">
          <span class="badge badge-secondary float-right mr-1">{{ App\Wagon::detainedCount() }}</span>
        </a>
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
        <div>
          @if($curDayDetainedCount)
            <a href="{{ route('recent', ['today', 'detained']) }}">
              <span class="badge badge-secondary">{{ $curDayDetainedCount }}</span>
            </a>
          @else
            <span class="badge badge-secondary">{{ $curDayDetainedCount }}</span>
          @endif
        </div>
      </div>
      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Выпущено</div>
        <div>
          @if($curDayReleasedCount)
            <a href="{{ route('recent', ['today', 'released']) }}">
              <span class="badge badge-primary">{{ $curDayReleasedCount }}</span>
            </a>
          @else
            <span class="badge badge-primary">{{ $curDayReleasedCount }}</span>
          @endif
        </div>
      </div>

      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Отправлено</div>
        <div>
          @if($curDayDepartedCount)
            <a href="{{ route('recent', ['today', 'departed']) }}">
              <span class="badge badge-success">{{ $curDayDepartedCount }}</span>
            </a>
          @else
            <span class="badge badge-success">{{ $curDayDepartedCount }}</span>
          @endif
        </div>
      </div>
    </div>

    <p class="text-center lead">Вчера {{ Carbon\Carbon::parse('-1 day')->format('d.m.Y') }} г.</p>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Задержано</div>
      <div>
        @if($prevDayDetainedCount)
          <a href="{{ route('recent', ['yesterday', 'detained']) }}">
            <span class="badge badge-secondary">{{ $prevDayDetainedCount }}</span>
          </a>
        @else
          <span class="badge badge-secondary">{{ $prevDayDetainedCount }}</span>
        @endif
      </div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Выпущено</div>
      <div>
        @if($prevDayReleasedCount)
          <a href="{{ route('recent', ['yesterday', 'released']) }}">
            <span class="badge badge-primary">{{ $prevDayReleasedCount }}</span>
          </a>
        @else
          <span class="badge badge-primary">{{ $prevDayReleasedCount }}</span>
        @endif
      </div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3 mb-2">
      <div>Отправлено</div>
      <div>
        @if($prevDayDepartedCount)
          <a href="{{ route('recent', ['yesterday', 'departed']) }}">
            <span class="badge badge-success">{{ $prevDayDepartedCount }}</span>
          </a>
        @else
          <span class="badge badge-success">{{ $prevDayDepartedCount }}</span>
        @endif
      </div>
    </div>
  </div>
</aside>

