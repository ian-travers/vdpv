<div class="card border-primary">
  <div class="card-header text-white bg-primary">
    Администрирование
  </div>
  <nav class="nav flex-column">
    <ul class="list-group">
      <li class="list-group-item list-group-item-action @if($controller == 'WagonsController') active-nav @endif">
        <a class="nav-link" href="{{ route('admin.wagons.index') }}">Вагоны</a>
      </li>
      <li class="list-group-item list-group-item-action @if($controller == 'UsersController') active-nav @endif">
        <a class="nav-link" href="{{ route('admin.users.index') }}">Пользователи</a>
      </li>
      <li class="list-group-item list-group-item-action @if($controller == 'DetainersController') active-nav @endif">
        <a class="nav-link" href="{{ route('admin.detainers.index') }}">Задерживающие организации</a>
      </li>
    </ul>
  </nav>
</div>

