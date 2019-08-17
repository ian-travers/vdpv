@extends('layouts.auth')

@section('content')
  <div class="container constrain">
    <div class="row justify-content-center pt-4">
      <div class="card w-100">
        <div class="card-header">
          <h3 class="text-center text-dark">Вход в систему</h3>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('login') }}">

            @csrf
            <div class="form-group">
              <label for="username" class="font-weight-bolder">Имя пользователя</label>
              <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                     name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

              @error('username')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="form-group">
              <label for="password" class="font-weight-bolder">Пароль</label>

              @if (Route::has('password.request'))
                <span class="float-right"><a class="btn-link" href="{{ route('password.request') }}"
                                             tabindex="9">Забыли пароль?</a></span>
              @endif
              <input id="password" type="password"
                     class="form-control @error('password') is-invalid @enderror" name="password" required
                     autocomplete="current-password">

              @error('password')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
              @enderror
            </div>

            <div class="form-group border-bottom pb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember"
                       id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">Запомнить меня</label>
              </div>
            </div>
            <div class="d-flex align-items-end mb-0 mt-3">
              <button type="submit" class="btn btn-outline-primary btn-lg">Вход</button>
              <button class="ml-auto btn btn-outline-secondary btn-sm" type="button"
                      onclick="window.history.back()">Отмена</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>



@endsection
