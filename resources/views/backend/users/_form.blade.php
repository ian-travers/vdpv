@php /* @var App\User $user */ @endphp

<div class="row">
  <div class="col">
    <div class="form-group shadow p-3 mb-3 bg-light rounded-lg required">
      <label for="username">Имя для входа на сайт</label>
      <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}"
             class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" autofocus>

      @if($errors->has('username'))
        <div class="invalid-feedback">
          <strong>{{ $errors->first('username') }}</strong>
        </div>

      @endif
    </div>

    <div class="form-group shadow p-3 mb-3 bg-light rounded-lg required">
      <label for="role" class="col-form-label">Уровень доступа (роль)</label>
      <select id="role" class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}" name="role">

        @foreach ($roles as $value => $label)
          <option value="{{ $value }}"{{ $value === old('role', $user->role) ? ' selected' : '' }}>{{ $label }}</option>

        @endforeach;
      </select>

      @if ($errors->has('role'))
        <span class="invalid-feedback"><strong>{{ $errors->first('role') }}</strong></span>

      @endif
    </div>

    @if(!$user->exists)
      <div class="form-group shadow p-3 mb-4 bg-light rounded-lg required">
        <label for="password">Пароль</label>
        <input type="text" id="password" name="password" value="{{ old('password', $user->password) }}"
               class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">

        @if($errors->has('password'))

          <div class="invalid-feedback">
            <strong>{{ $errors->first('password') }}</strong>
          </div>

        @endif
      </div>

    @endif
  </div>

  <div class="col">
    <div class="form-group shadow p-3 mb-3 bg-light rounded-lg required">
      <label for="name">ФИО или должность</label>
      <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
             class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" autofocus>

      @if($errors->has('name'))

        <div class="invalid-feedback">
          <strong>{{ $errors->first('name') }}</strong>
        </div>

      @endif
    </div>

    <div class="form-group shadow p-3 mb-3 bg-light rounded-lg required">
      <label for="email">Email</label>
      <input type="text" id="email" name="email" value="{{ old('email', $user->email) }}"
             class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">

      @if($errors->has('email'))

        <div class="invalid-feedback">
          <strong>{{ $errors->first('email') }}</strong>
        </div>

      @endif
    </div>
  </div>
</div>




