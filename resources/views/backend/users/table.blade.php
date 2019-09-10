@php /* @var \App\User $user */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr>
    <th class="text-center">Действия</th>
    <th>Имя входа</th>
    <th>Имя пользователя</th>
    <th>Роль</th>
    <th>Адрес e-mail</th>
    <th class="text-center">SA</th>
    <th class="text-center">Создан</th>
    <th class="text-center">Изменен</th>
    <th class="text-center">ID</th>
  </tr>
  </thead>
  <tbody>

  @foreach($users as $user)
    <tr>
      <td class="text-center">

        @if($user->isForceCanBeChanged())
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-outline-primary btn-sm fa fa-edit"
           title="Изменить"></a>

        @else
          <button type="button" class="btn btn-outline-primary btn-sm fa fa-edit disabled"></button>

        @endif

        <button
            type="button"
            class="btn btn-sm btn-outline-secondary fa fa-key
{{ $user->isForceCanBeChanged() ? '' : 'disabled' }}"

            @if($user->isForceCanBeChanged())
              title="Сменить пароль"
              data-toggle="modal"
              data-target="#changePasswordModal"
              data-user-id="{{ $user->id }}"
              data-user-name="{{ $user->name }}"

            @endif
        ></button>

        @if(!($user->id == auth()->id() or $user->id == config('app.protected_user_id')))
          <form class="d-inline" action="{{ route('admin.users.destroy', $user) }}" method="post">

            @method('delete')
            @csrf
            <button type="submit" onclick="return confirm('Подтверждаете удаление?')"
                    class="btn btn-outline-danger btn-sm fa fa-trash" title="Удалить"></button>
          </form>
        @else
          <button type="button"
                  class="btn btn-outline-danger btn-sm fa fa-trash disabled"></button>
        @endif
      </td>
      <td>{{ $user->username }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->getRole() }}</td>
      <td>{{ $user->email }}</td>
      <td class="text-center">{!! $user->isAdmin() ? '<span class="fa fa-check"></span>' : '' !!}</td>
      <td class="text-center">{{ $user->created_at }}</td>
      <td class="text-center">{{ $user->updated_at }}</td>
      <td class="text-center">{{ $user->id }}</td>
    </tr>

  @endforeach
  </tbody>
</table>

