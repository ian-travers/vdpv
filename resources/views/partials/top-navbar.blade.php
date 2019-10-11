@include('partials.custom-report-modal')
@include('partials.at-time-modal')

<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('storage/images/coal-wagon.png') }}" alt="" width="36" class="mr-3 my-n1">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto ml-4">

        @can('manage-wagons')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('wagons.index') }}">Работа с вагонами</a>
          </li>

        @endcan
        <li class="nav-item">
          <a class="nav-link" href="{{ route('help') }}">Руководство пользователя</a>
        </li>
        <li class="nav-item dropdown">
          <a href="" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
             aria-expanded="false" v-pre>Отчеты по задержанным вагонам <span class="caret"></span></a>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#at-time-report">
              На дату-время
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('reports.last') }}">
              Последняя смена
            </a>
            <a class="dropdown-item" href="{{ route('reports.previous') }}">
              Предпоследняя смена
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#custom-report">Произвольный период</a>
          </div>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->

        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Вход</a>
          </li>

          {{--          @if (Route::has('register'))--}}
          {{--<li class="nav-item">--}}
          {{--<a class="nav-link" href="{{ route('register') }}">Регистрация</a>--}}
          {{--</li>--}}

          {{--@endif--}}
        @else
          @can('manage-station')
            <li class="nav-item">
              <a class="nav-link" href="{{ route('admin.overall') }}">Администрирование</a>
            </li>

          @endcan
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <p class="text-center m-3">Авторизация<br>
                <span class="badge badge-dark">{{ App\User::rolesList()[auth()->user()->role] }}</span>
              </p>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Выход
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST"
                    style="display: none;">

                @csrf
              </form>
            </div>
          </li>

        @endguest
      </ul>
    </div>
  </div>
</nav>

