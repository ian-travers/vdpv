@extends('layouts.backend')

@section('content')
  <div class="card">
    <div class="card-header bg-light">
      <div class="d-flex justify-content-between align-items-start">
        <h3>Управление задерживающими организациями</h3>
        <a href="{{ route('admin.detainers.create') }}" class="btn btn-outline-primary">Добавить организацию</a>
      </div>
    </div>

    @if(count($detainers))
      @include('backend.detainers.table')
      <div class="px-3">
        {{ $detainers->appends(request()->except('page'))->links() }}
      </div>

    @endif
  </div>
@endsection



