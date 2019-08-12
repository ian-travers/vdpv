@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')
  <div class="container">
    <div class="card mt-3">
      <div class="card-header bg-info">
        <h2>Общие сведения</h2>
      </div>
      <div class="card-body">
        <div class="d-flex flex-column">
          <div class="row border-secondary border-bottom">
            <div class="col-6">&nbsp;</div>
            <div class="col-3 text-right">Задержано, шт.</div>
            <div class="col-3 text-right">В т.ч. длительно стоящие, шт.</div>
          </div>

          <div class="row">
            <div class="col-6">Всего</div>
            <div class="col-3 text-right">{{ $total }}</div>
            <div class="col-3 text-right">{{ $totalLong }}</div>
          </div>

          @foreach($detainers as $detainer)
          <div class="row">
            <div class="col-6">{{ $detainer->name }}</div>
            <div class="col-3 text-right">{{ $detainer->wagons->count() }}</div>
            <div class="col-3 text-right">{{ App\Wagon::detainedLongCount($detainer) }}</div>
          </div>

          @endforeach
        </div>
      </div>
    </div>
  </div>
@endsection

