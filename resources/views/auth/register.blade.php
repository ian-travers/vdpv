@extends('layouts.auth')

@section('content')
  <div class="container constrain">
    <div class="row justify-content-center pt-4">
      <div class="card w-100">
        <div class="card-header">
          <h3 class="text-center text-dark">Регистрация</h3>
        </div>
        <div class="card-body">
          <form method="post" action="{{ route('register') }}">

            @csrf
            <div class="form-group">
              <label for="name" class="font-weight-bolder">Имя в системе</label>
              <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                     value="{{ old('name') }}" required autocomplete="name" autofocus>

              @error('name')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="form-group">
              <label for="username" class="font-weight-bolder">Имя пользователя</label>
              <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                     name="username" value="{{ old('username') }}" required autocomplete="username">

              @error('username')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="form-group">
              <label for="email" class="font-weight-bolder">Адрес электронной почты</label>

              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                     value="{{ old('email') }}" required autocomplete="email">

              @error('email')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="form-group">
              <label for="password" class="font-weight-bolder">Пароль</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                     name="password" required autocomplete="new-password">

              @error('password')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="form-group border-bottom pb-3">
              <label for="password-confirm" class="font-weight-bolder">Повторите пароль</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                     autocomplete="new-password">
            </div>

            <div class="d-flex align-items-end mb-0 mt-3">
              <button type="submit" class="btn btn-outline-primary btn-lg">Регистрация</button>
              <button class="ml-auto btn btn-outline-secondary btn-sm" type="button"
                      onclick="window.history.back()">Отмена</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
