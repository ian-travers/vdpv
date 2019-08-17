@extends('layouts.auth')

@section('content')
  <div class="container constrain">
    <div class="row justify-content-center pt-4">
      <div class="card w-100">
        <div class="card-header">
          <h3 class="text-center text-dark">Восстановление пароля</h3>
        </div>

        <div class="card-body">

          @if (session('status'))
            <div class="alert alert-success" role="alert">
              {{ session('status') }}
            </div>

          @endif
          <form method="post" action="{{ route('password.email') }}">

            @csrf
            <div class="form-group border-bottom pt-4">
              <label for="email" class="font-weight-bolder">Адрес электронной почты</label>
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>

              @enderror
            </div>

            <div class="d-flex align-items-end">
              <button type="submit"
                      class="btn btn-outline-primary btn-lg">Восстановить пароль</button>
              <button class="ml-auto btn btn-outline-secondary btn-sm" type="button"
                      onclick="window.history.back()">Отмена</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
