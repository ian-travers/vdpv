@php /* @var \App\User $user */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr>
    <th class="text-center">Действия</th>
    <th>Имя входа</th>
    <th>Имя пользователя</th>
    <th>Адрес e-mail</th>
    <th>Администратор</th>
    <th class="text-center">Создан</th>
    <th class="text-center">Изменен</th>
  </tr>
  </thead>
  <tbody>

  @foreach($users as $user)
    <tr>
      <td></td>
      <td>{{ $user->username }}</td>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td class="text-center">{!! $user->isAdmin() ? '<span class="fa fa-check"></span>' : '' !!}</td>
      <td class="text-center">{{ $user->created_at }}</td>
      <td class="text-center">{{ $user->updated_at }}</td>
    </tr>

  @endforeach
  </tbody>
</table>

