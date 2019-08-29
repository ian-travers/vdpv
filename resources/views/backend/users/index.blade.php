@extends('layouts.app')

@section('content')
  <div class="container-fluid">
    <div class="row mt-2">
      <div class="col-2">
        @include('backend.left-sidebar')
      </div>
      <div class="col-10">
        <div class="card">
          <div class="card-header bg-light">
            <div class="d-flex justify-content-between align-items-start">
              <h3>Управление пользователями</h3>
              <a href="#" class="btn btn-outline-primary">Добавить пользователя</a>
            </div>
          </div>

            @if(count($users))
              @include('backend.users.table')
            <div class="px-3">
              {{ $users->appends(request()->except('page'))->links() }}
            </div>

            @endif
        </div>





      </div>
    </div>
  </div>
@endsection

