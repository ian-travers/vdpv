@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr class="text-center text-muted">
    <th width="6%">№</th>
    <th width="10%">Номер</th>
    <th width="12%">Простой, дн.</th>
    <th width="10%">Простой, ч.</th>
    <th width="20%">Простой после выпуска, ч.</th>
    <th>Причина</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td class="text-center">{{ (request('page')) ? (request('page') - 1) * $wagons->perPage() + $loop->index + 1 : $loop->index + 1 }}</td>
      <td class="text-center"><a href="{{ $wagon->viewPath() }}" class="{{ $wagon->linkCssClass() }}">{{ $wagon->inw }}</a></td>
      <td class="text-center">{{ $wagon->detained_at->diffInDays() }}</td>
      <td class="text-center">{{ $wagon->detainedInHours() }}</td>
      <td class="text-center">{{ $wagon->detainedAfterReleaseInHours() }}</td>
      <td>{{ $wagon->reason }}</td>
    </tr>

  @endforeach
  </tbody>
</table>

