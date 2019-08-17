@extends('layouts.auth')

@section('content')
  <div class="container constrain">
    <div class="row justify-content-center">
      <div class="card w-100">
        <div class="card-header">
          <h3 class="text-center text-dark">Восстановление пароля</h3>
        </div>

        <div class="card-body">
          <form method="post" action="{{ route('password.update') }}">

            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
              <label for="email" class="font-weight-bolder">Адрес электронной почты</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                     value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="form-group">
              <label for="password" class="font-weight-bolder">Новый пароль</label>
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                     name="password" required autocomplete="new-password">

              @error('password')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="form-group pb-4 border-bottom">
              <label for="password-confirm" class="font-weight-bolder">Повторите пароль</label>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                     autocomplete="new-password">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-outline-primary btn-lg">
                Установить пароль
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
  </div>
@endsection
