@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <h2>Редактирование вагона</h2>
      <form action="{{route('wagons.update', $wagon->id)}}" method="post">

        @method('patch')
        @include('wagons._form')
      </form>
  </div>
@endsection




