@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-striped table-bordered">
  <thead>
  <tr class="text-center text-muted">
    <th>№</th>
    <th>Номер</th>
    <th>Кем</th>
    <th>Причина</th>
    <th>Собственность</th>
    {{--<th>Ст. отпр.</th>--}}
    {{--<th>Ст. назн.</th>--}}
    <th>Прибыл</th>
    <th>Задержан</th>
    <th>Принятые меры</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td><a href="{{ $wagon->viewPath() }}">{{ $wagon->inw }}</a></td>
      <td>{{ $wagon->detainer->name }}</td>
      <td>{{ $wagon->reason }}</td>
      <td>{{ $wagon->ownership }}</td>
{{--      <td>{{ $wagon->departure_station }}</td>--}}
{{--      <td>{{ $wagon->destination_station }}</td>--}}
      <td class="text-center">{{ $wagon->arrived_at->format('d.m.Y H:i') }}</td>
      <td class="text-center">{{ $wagon->detained_at->format('d.m.Y H:i') }}</td>
      <td>{{ $wagon->taken_measure }}</td>
    </tr>

  @endforeach
  </tbody>
</table>

