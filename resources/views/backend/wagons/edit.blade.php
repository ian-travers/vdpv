@php /* @var App\Wagon $wagon */ @endphp

@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mb-3">
      <div class="col-2">

        @include('backend.left-sidebar')
      </div>
      <div class="col-10">
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
      </div>
    </div>
  </div>
@endsection

