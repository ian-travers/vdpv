@extends('layouts.auth')

@section('content')
  <div class="container constrain">
    <div class="row justify-content-center pt-4">
      <div class="card w-100">
        <div class="card-header">
          <h3 class="text-center text-dark">Подтвердите ваш email</h3>
        </div>

        <div class="card-body">

          @if (session('resent'))
            <div class="alert alert-success" role="alert">
              Письмо для подтверждение отправлено на ваш email.
            </div>

          @endif

          <p>Проверьте вашу электронную почту. Там будет письмо с ссылкой для подтверждения</p>
          <p>Если письма нет, <a
              href="{{ route('verification.resend') }}">Кликните здесь для формарования нового письма</a><p></p>.
        </div>
      </div>
    </div>
  </div>
@endsection
