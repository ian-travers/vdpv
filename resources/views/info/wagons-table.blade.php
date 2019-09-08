@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr class="text-center text-muted">
    <th width="6%" class="align-top">№ п/п</th>
    <th width="10%" class="align-top">Номер вагона</th>
    <th width="12%" class="align-top">Простой с момента задержания, дн.</th>
    <th width="11%" class="align-top">Простой с момента задержания, ч.</th>
    <th width="13%" class="align-top">Простой после выпуска, ч.</th>
    <th class="align-top">Причина</th>
    <th width="8%" class="align-top">Возврат</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td class="text-center">{{ (request('page')) ? (request('page') - 1) * $wagons->perPage() + $loop->index + 1 : $loop->index + 1 }}</td>
      <td class="text-center">
        <a href="{{ $wagon->viewPath() }}" class="{{ $wagon->linkCssClass() }}">
          {{ $wagon->inw }}

          @if($wagon->isHasAnotherDetaining())
            <span class="badge badge-warning border align-top float-right" title="Есть дополнительная информация">!</span>

          @endif
        </a>


      </td>
      <td class="text-center">{{ $wagon->detainedInDays() }}</td>
      <td class="text-center">{{ $wagon->detainedInHours() }}</td>
      <td class="text-center">{{ $wagon->detainedAfterReleaseInHours() }}</td>
      <td>{{ $wagon->reason }}</td>
      <td class="text-center">{!! $wagon->renderReturning() !!}</td>
    </tr>

  @endforeach
  </tbody>
</table>

