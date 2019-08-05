@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <h1>Редактирование вагона</h1>
    <div class="bg-white rounded border border-secondary p-3">
      <h2>Информация по вагону</h2>
      <form action="{{route('wagons.update', $wagon->id)}}" method="post">

        @method('patch')
        @include('wagons._form')
      </form>
    </div>

  </div>
@endsection




