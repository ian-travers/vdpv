@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-bordered">
  <thead>
  <tr class="text-center text-muted">
    <th width="10%">№</th>
    <th width="15%">Номер</th>
    <th width="15%">Простой, дн.</th>
    <th width="15%">Простой, ч.</th>
    <th>Причина</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td class="text-center">{{ (request('page')) ? (request('page') - 1) * 10 + $loop->index + 1 : $loop->index + 1 }}</td>
      <td class="text-center"><a href="{{ $wagon->viewPath() }}">{{ $wagon->inw }}</a></td>
      <td class="text-right">{{ $wagon->detained_at->diffInDays() }}</td>
      <td class="text-right">{{ $wagon->detainedInHours() }}</td>
      <td>{{ $wagon->reason }}</td>
    </tr>

  @endforeach
  </tbody>
</table>

