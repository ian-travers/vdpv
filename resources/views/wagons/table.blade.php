@php /* @var App\Wagon $wagon */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr class="text-center">
    <th>№</th>
    <th>Номер</th>

    @if(!auth()->user()->isLocalWagonsManager())
      <th width="15%" class="text-center">@sortablelink('detainer_id', 'Категория')</th>

    @endif
    <th>Причина</th>

    @if(!auth()->user()->isLocalWagonsManager())
      <th>Груз/Эксп./Соб.</th>

    @endif
    <th width="10%" class="text-center">@sortablelink('arrived_at', 'Прибыл')</th>
    <th width="10%" class="text-center">@sortablelink('detained_at', 'Задержан')</th>
    <th width="10%" class="text-center">@sortablelink('released_at', 'Выпущен')</th>

    @if(auth()->user()->isLocalWagonsManager())
      <th width="10%" class="text-center">@sortablelink('delivered_at', 'Подан')</th>
      <th width="10%" class="text-center">@sortablelink('cargo_operation_finished_at', 'Конец гр. оп.')</th>
      <th width="10%" class="text-center">@sortablelink('removed_at', 'Убран')</th>

    @endif
    <th width="10%" class="text-center">@sortablelink('departed_at', 'Отправлен')</th>
    <th width="7%" class="text-center">Действия</th>
  </tr>
  </thead>
  <tbody>

  @foreach($wagons as $wagon)
    <tr>
      <td class="text-center">{{ (request('page')) ? (request('page') - 1) * $wagons->perPage() + $loop->index + 1 : $loop->index + 1 }}</td>
      <td><a href="{{ $wagon->path() }}">{{ $wagon->inw }}</a></td>

      @if(!auth()->user()->isLocalWagonsManager())
        <td>{{ $wagon->detainer->name }}</td>

      @endif
      <td>{{ $wagon->reason }}</td>

      @if(!auth()->user()->isLocalWagonsManager())
        <td>{{ $wagon->cargo }} / {{ $wagon->forwarder }} / {{ $wagon->ownership }}</td>

      @endif
      <td class="text-center">{{ $wagon->arrived_at ? $wagon->arrived_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">{{ $wagon->detained_at ? $wagon->detained_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">{{ $wagon->released_at ? $wagon->released_at->format('d.m.Y H:i') : '' }}</td>

      @if(auth()->user()->isLocalWagonsManager())
        <td class="text-center">{{ $wagon->delivered_at ? $wagon->delivered_at->format('d.m.Y H:i') : '' }}</td>
        <td class="text-center">{{ $wagon->cargo_operation_finished_at ? $wagon->cargo_operation_finished_at->format('d.m.Y H:i') : '' }}</td>
        <td class="text-center">{{ $wagon->removed_at ? $wagon->removed_at->format('d.m.Y H:i') : '' }}</td>

      @endif
      <td class="text-center">{{ $wagon->departed_at ? $wagon->departed_at->format('d.m.Y H:i') : '' }}</td>
      <td class="text-center">
        <a href="{{ route('wagons.edit', $wagon) }}" class="btn btn-sm btn-outline-primary fa fa-edit"
           title="Редактировать"></a>
        <form action="{{ route('wagons.destroy', $wagon) }}" method="post" class="d-inline">

          @csrf
          @method('delete')
          <button type="submit" onclick="return confirm('Подтверждаете удаление?')"
                  class="btn btn-sm btn-outline-danger fa fa-trash-alt" title="Удалить"></button>
        </form>
      </td>
    </tr>


  @endforeach
  </tbody>
</table>

