@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr class="text-center">
    <th width="4%">№</th>
    <th width="5%">Номер</th>
    <th width="15%" class="text-center">@sortablelink('detainer_id', 'Категория')</th>
    <th width="10%" class="text-center">@sortablelink('arrived_at', 'Прибыл')</th>
    <th width="10%" class="text-center">@sortablelink('detained_at', 'Задержан')</th>
    <th width="10%" class="text-center">@sortablelink('released_at', 'Выпущен')</th>
    <th width="10%" class="text-center">@sortablelink('departed_at', 'Отправлен')</th>
    <th width="10%" class="text-center">Действия</th>
    <th width="4%" class="text-center">ID</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td class="text-center">{{ (request('page')) ? (request('page') - 1) * $wagons->perPage() + $loop->index + 1 : $loop->index + 1 }}</td>
      <td><a href="{{ route('admin.wagons.show', $wagon) }}">{{ $wagon->inw }}</a></td>
      <td>{{ $wagon->detainer->name }}</td>
      <td class="text-center">{{ $wagon->arrived_at ? $wagon->arrived_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">{{ $wagon->detained_at ? $wagon->detained_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">{{ $wagon->released_at ? $wagon->released_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">
        <a href="{{ route('admin.wagons.show', $wagon) }}" class="btn btn-sm btn-outline-primary fa fa-eye"
           title="Посмотреть"></a>
        <a href="{{ route('admin.wagons.edit', $wagon) }}" class="btn btn-sm btn-outline-primary fa fa-edit"
           title="Изменить"></a>
        <form action="{{ route('admin.wagons.destroy', $wagon) }}" method="post" class="d-inline">

          @csrf
          @method('delete')
          <button type="submit" onclick="return confirm('Подтверждаете удаление?')"
                  class="btn btn-sm btn-outline-danger fa fa-trash-alt" title="Удалить"></button>
        </form>
      </td>
      <td class="text-center text-muted">{{ $wagon->id }}</td>
    </tr>

  @endforeach
  </tbody>
</table>



