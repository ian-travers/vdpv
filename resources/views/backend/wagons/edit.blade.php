@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.backend')

@section('content')
  <div class="card border-primary">
    <div class="card-header">
      <h3>Редактирование вагона</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.wagons.update', $wagon->id) }}" method="post">

        @method('patch')
        @include('backend.wagons._form')
      </form>
    </div>
  </div>
@endsection

