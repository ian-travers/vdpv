@extends('layouts.app')

@section('breadcrumbs', '')

@section('content')
  <div class="container-fluid">
    <h3 class="mt-3">Задержано: {{ $detainer->name }}</h3>
    <div class="row mt-3">
      <div class="col-9">

        @if(!$wagons->count())
          <div class="alert alert-warning">
            Ничего не найдено!
          </div>

        @else
          @include('info.wagons-table')
          <nav>
            {{ $wagons->appends(request()->only(['term']))->links() }}
          </nav>

        @endif
      </div>
      <div class="col-3">

        @include('info.sidebar')
      </div>
    </div>
  </div>
@endsection

