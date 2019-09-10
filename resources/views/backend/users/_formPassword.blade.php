@php /* @var App\User $user */ @endphp

<div class="form-group">
  <label for="password">Пароль</label>
  <input type="text" id="password" name="password" value="{{ old('password') }}"
         class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">

  @if($errors->has('password'))
    <div class="invalid-feedback">
      <strong>{{ $errors->first('password') }}</strong>
    </div>

  @endif
</div>


