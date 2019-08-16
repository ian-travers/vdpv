@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr class="text-center">
    <th>№</th>
    <th>Номер</th>
    <th>Кем задержан</th>
    <th>Причина</th>
    <th>Груз/Эксп./Соб.</th>
    <th>Задержан</th>
    <th>Выпущен</th>
    <th>Отправлен</th>
    <th width="7%" class="text-center">Действия</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td class="text-center">{{ (request('page')) ? (request('page') - 1) * $wagons->perPage() + $loop->index + 1 : $loop->index + 1 }}</td>
      <td><a href="{{ $wagon->path() }}">{{ $wagon->inw }}</a></td>
      <td>{{ $wagon->detainer->name }}</td>
      <td>{{ $wagon->reason }}</td>
      <td>{{ $wagon->cargo }} / {{ $wagon->forwarder }} / {{ $wagon->ownership }}</td>
      <td class="text-center">{{ $wagon->detained_at->format('d.m.Y H:i') }}</td>
      <td class="text-center">{{ $wagon->released_at ? $wagon->released_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">
        <a href="{{ route('wagons.edit', $wagon) }}" class="btn btn-sm btn-outline-primary fa fa-edit" title="Редактировать"></a>
        <form action="{{ route('wagons.destroy', $wagon) }}" method="post" class="d-inline">

          @csrf
          @method('delete')
          <button type="submit" onclick="return confirm('Подтверждаете удаление?')" class="btn btn-sm btn-outline-danger fa fa-trash-alt" title="Удалить"></button>
        </form>
      </td>
    </tr>


  @endforeach
  </tbody>
</table>

