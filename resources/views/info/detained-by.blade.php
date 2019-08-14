@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mt-3">
      <div class="col-9">
        <h3>{{ $detainer->name }}</h3>

        @if(!$wagons->count())
          <div class="alert alert-warning">
            Ничего не найдено!
          </div>

        @else
          @include('info.wagons-table')
        @endif

        <nav>
          {{ $wagons->appends(request()->only(['term']))->links() }}
        </nav>
      </div>
      <div class="col-3">

        @include('info.sidebar')
      </div>
    </div>
  </div>
@endsection

