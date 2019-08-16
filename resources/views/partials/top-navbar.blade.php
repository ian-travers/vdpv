<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('storage/images/tank-wagon.png') }}" alt="" width="36" class="mr-3 my-n1">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto ml-4">

        @if(auth()->check())
          <li class="nav-item">
            <a class="nav-link" href="{{ route('wagons.index') }}">Работа с вагонами</a>
          </li>

        @endif
        <li class="nav-item dropdown">
          <a href="" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
             aria-expanded="false" v-pre>Отчеты по задержанным вагонам <span class="caret"></span></a>
          <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">
              Вчерашняя смена (8:00 {{ Carbon\Carbon::parse('-1 day')->format('d.m.Y') }} &mdash;
              20:00 {{ Carbon\Carbon::parse('-1 day')->format('d.m.Y') }})
            </a>
            <a class="dropdown-item" href="#">
              Предыдущая смена (20:00 {{ Carbon\Carbon::parse('-1 day')->format('d.m.Y') }} &mdash;
              8:00 {{ Carbon\Carbon::now()->format('d.m.Y') }})
            </a>
            <a class="dropdown-item" href="#">
              Текущая смена (c 8:00 {{ Carbon\Carbon::now()->format('d.m.Y') }})
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Произвольный отчет</a>
          </div>
        </li>
      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav ml-auto">
        <!-- Authentication Links -->
        @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
          @endif
        @else
          <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
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

