@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-striped table-bordered">
  <thead>
  <tr>
    <th>№</th>
    <th>Номер</th>
    <th>Кем задержан</th>
    <th>Причина</th>
    <th>Груз/Эксп./Соб.</th>
    <th>Ст. отпр.</th>
    <th>Ст. назн.</th>
    <th>Прибыл</th>
    <th>Задержан</th>
    <th>Принятые меры</th>
    <th width="7%" class="text-center">Действия</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td><a href="{{ $wagon->path() }}">{{ $wagon->inw }}</a></td>
      <td>{{ $wagon->detainer->name }}</td>
      <td>{{ $wagon->reason }}</td>
      <td>{{ $wagon->cargo }} / {{ $wagon->forwarder }} / {{ $wagon->ownership }}</td>
      <td>{{ $wagon->departure_station }}</td>
      <td>{{ $wagon->destination_station }}</td>
      <td class="text-center">{{ $wagon->arrived_at->format('d.m.Y H:i') }}</td>
      <td class="text-center">{{ $wagon->detained_at->format('d.m.Y H:i') }}</td>
      <td>{{ $wagon->taken_measure }}</td>
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

