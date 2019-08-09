@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <h2>Добавление вагона</h2>
    <form action="{{ route('wagons.store') }}" method="post">

      @include('wagons._form', [$wagon = new App\Wagon()])
    </form>
  </div>
@endsection


