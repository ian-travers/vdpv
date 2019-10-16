@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-2">

        @include('backend.left-sidebar')
      </div>
      <div class="col-10">
        <h2>Редактирование вагона</h2>
        <form action="{{ route('admin.wagons.update', $wagon->id) }}" method="post">

          @method('patch')
          @include('backend.wagons._form')
        </form>
      </div>
    </div>
  </div>
@endsection

