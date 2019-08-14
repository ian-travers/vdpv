@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-bordered">
  <thead>
  <tr class="text-center text-muted">
    <th>№</th>
    <th>Номер</th>
    <th>Простой, ч.</th>
    <th>Причина</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td class="text-center">{{ $loop->index + 1 }}</td>
      <td class="text-center"><a href="{{ $wagon->viewPath() }}">{{ $wagon->inw }}</a></td>
      <td class="text-right">{{ $wagon->detainedInHours() }}</td>
      <td>{{ $wagon->reason }}</td>
    </tr>

  @endforeach
  </tbody>
</table>

