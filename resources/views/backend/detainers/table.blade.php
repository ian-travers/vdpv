@php /* @var \App\Detainer $detainer */ @endphp

<table class="table table-sm table-bordered">
  <thead>
  <tr>
    <th width="10%" class="text-center">Действия</th>
    <th>Наименование</th>
    <th>Событие для отсчета простоя</th>
    <th width="8%" class="text-center">ID</th>
  </tr>
  </thead>
  <tbody>

  @foreach($detainers as $detainer)
    <tr>
      <td class="text-center">

        <a href="{{ route('admin.detainers.edit', $detainer) }}" class="btn btn-outline-primary btn-sm fa fa-edit" title="Изменить"></a>

        @if($detainer->isDeletable())
        <form class="d-inline" action="{{ route('admin.detainers.destroy', $detainer) }}" method="post">

          @method('delete')
          @csrf
          <button type="submit" onclick="return confirm('Подтверждаете удаление?')"
                  class="btn btn-outline-danger btn-sm fa fa-trash" title="Удалить"></button>
        </form>

        @else
          <button type="button"
                  class="btn btn-outline-danger btn-sm fa fa-trash disabled"></button>

        @endif
      </td>
      <td>{{ $detainer->name }}</td>
      <td>{{ $detainer->idle_start_event }}</td>
      <td class="text-center">{{ $detainer->id }}</td>
    </tr>

  @endforeach
  </tbody>
</table>



