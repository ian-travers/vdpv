@extends('layouts.backend')

@section('content')
  <div class="card border-primary">
    <div class="card-header">
      <h3>Новый вагон</h3>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.wagons.store') }}" method="post">

        @include('backend.wagons._form', [$wagon = new App\Wagon()])
      </form>
    </div>
  </div>
@endsection
