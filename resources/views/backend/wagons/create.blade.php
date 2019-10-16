@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-2">

        @include('backend.left-sidebar')
      </div>
      <div class="col-10">
        <h2>Добавление вагона</h2>
        <form action="{{ route('admin.wagons.store') }}" method="post">

          @include('backend.wagons._form', [$wagon = new App\Wagon()])
        </form>
      </div>
    </div>
  </div>
@endsection
