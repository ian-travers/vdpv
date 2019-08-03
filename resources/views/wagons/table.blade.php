@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-striped table-bordered">
  <thead>
  <tr>
    <th>№</th>
    <th>Номер</th>
    <th>Причина</th>
    <th>Груз/Эксп./Соб.</th>
    <th>Ст. отпр.</th>
    <th>Ст. назн.</th>
    <th>Прибыл</th>
    <th>Задержан</th>
    <th>Пинятые меры</th>
    <th width="8%" class="text-center">Действия</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td><a href="{{ $wagon->path() }}">{{ $wagon->inw }}</a></td>
      <td>{{ $wagon->reason }}</td>
      <td>{{ $wagon->cargo }} / {{ $wagon->forwarder }} / {{ $wagon->ownership }}</td>
      <td>{{ $wagon->departure_station }}</td>
      <td>{{ $wagon->destination_station }}</td>
      <td>{{ $wagon->arrived_at->format('d.m.Y H:i') }}</td>
      <td>{{ $wagon->detained_at->format('d.m.Y H:i') }}</td>
      <td>{{ $wagon->taken_measure }}</td>
      <td class="text-center">
        <a href="/wagons/{{ $wagon->id }}/edit" class="btn btn-sm btn-outline-primary">Р</a>
        <a href="/wagons/{{ $wagon->id }}/release" class="btn btn-sm btn-outline-success">В</a>
        <a href="/wagons/{{ $wagon->id }}/delete" class="btn btn-sm btn-outline-danger">У</a>
      </td>
    </tr>


  @endforeach
  </tbody>
</table>

