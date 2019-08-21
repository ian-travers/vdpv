@php /* @var App\Detainer $detainer */ @endphp

<aside>
  <div class="search-widget">

    <form action="{{ route('root') }}">
      <div class="input-group input-group-lg">
        <input type="text" class="form-control" value="{{ request('term') }}" name="term"
               placeholder="Поиск..." autofocus>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div><!-- /input-group -->
    </form>

  </div>

  {{--Последние изменения--}}
  <div class="widget">
    <div class="widget-heading">
      <h4>Последние изменения</h4>
    </div>
    <div class="widget-body mb-3">
      <p class="text-center lead">Сегодня {{ Carbon\Carbon::now()->format('d.m.Y') }} г.</p>
      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Задержано</div>
        <div>
          @if($todayDetainedCount)
            <a href="{{ route('recent', ['today', 'detained']) }}">
              <span class="badge badge-primary">{{ $todayDetainedCount }}</span>
            </a>
          @else
            <span class="badge badge-primary">{{ $todayDetainedCount }}</span>
          @endif
        </div>
      </div>
      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Выпущено</div>
        <div>
          @if($todayReleasedCount)
            <a href="{{ route('recent', ['today', 'released']) }}">
              <span class="badge badge-secondary">{{ $todayReleasedCount }}</span>
            </a>
          @else
            <span class="badge badge-secondary">{{ $todayReleasedCount }}</span>
          @endif
        </div>
      </div>

      <div class="d-flex justify-content-between align-self-center px-3">
        <div>Отправлено</div>
        <div>
          @if($todayDepartedCount)
            <a href="{{ route('recent', ['today', 'departed']) }}">
              <span class="badge badge-success">{{ $todayDepartedCount }}</span>
            </a>
          @else
            <span class="badge badge-success">{{ $todayDepartedCount }}</span>
          @endif
        </div>
      </div>
    </div>

    <p class="text-center lead">Вчера {{ Carbon\Carbon::parse('-1 day')->format('d.m.Y') }} г.</p>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Задержано</div>
      <div>
        @if($yesterdayDetainedCount)
          <a href="{{ route('recent', ['yesterday', 'detained']) }}">
            <span class="badge badge-primary">{{ $yesterdayDetainedCount }}</span>
          </a>
        @else
          <span class="badge badge-primary">{{ $yesterdayDetainedCount }}</span>
        @endif
      </div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Выпущено</div>
      <div>
        @if($yesterdayReleasedCount)
          <a href="{{ route('recent', ['yesterday', 'released']) }}">
            <span class="badge badge-secondary">{{ $yesterdayReleasedCount }}</span>
          </a>
        @else
          <span class="badge badge-secondary">{{ $yesterdayReleasedCount }}</span>
        @endif
      </div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3 mb-2">
      <div>Отправлено</div>
      <div>
        @if($yesterdayDepartedCount)
          <a href="{{ route('recent', ['yesterday', 'departed']) }}">
            <span class="badge badge-success">{{ $yesterdayDepartedCount }}</span>
          </a>
        @else
          <span class="badge badge-success">{{ $yesterdayDepartedCount }}</span>
        @endif
      </div>
    </div>

    <p class="text-center lead">Позавчера {{ Carbon\Carbon::parse('-2 day')->format('d.m.Y') }} г.</p>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Задержано</div>
      <div>
        @if($beforeYesterdayDetainedCount)
          <a href="{{ route('recent', ['before-yesterday', 'detained']) }}">
            <span class="badge badge-primary">{{ $beforeYesterdayDetainedCount }}</span>
          </a>
        @else
          <span class="badge badge-primary">{{ $beforeYesterdayDetainedCount }}</span>
        @endif
      </div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Выпущено</div>
      <div>
        @if($beforeYesterdayReleasedCount)
          <a href="{{ route('recent', ['before-yesterday', 'released']) }}">
            <span class="badge badge-secondary">{{ $beforeYesterdayReleasedCount }}</span>
          </a>
        @else
          <span class="badge badge-secondary">{{ $beforeYesterdayReleasedCount }}</span>
        @endif
      </div>
    </div>
    <div class="d-flex justify-content-between align-self-center px-3">
      <div>Отправлено</div>
      <div>
        @if($beforeYesterdayDepartedCount)
          <a href="{{ route('recent', ['before-yesterday', 'departed']) }}">
            <span class="badge badge-success">{{ $beforeYesterdayDepartedCount }}</span>
          </a>
        @else
          <span class="badge badge-success">{{ $beforeYesterdayDepartedCount }}</span>
        @endif
      </div>
    </div>
  </div>
</aside>

