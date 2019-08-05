@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <h1>Добавление вагона</h1>
    <div class="bg-white rounded border border-secondary p-3">
      <h2>Информация по вагону</h2>
      <form action="{{ route('wagons.store') }}" method="post">

        @include('wagons._form', [$wagon = new App\Wagon()])
      </form>
    </div>

  </div>
@endsection


