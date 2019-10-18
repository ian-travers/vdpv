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
            <h3>Новый пользователь</h3>
          </div>
          <div class="card-body">
            <form id="user-form" action="{{ route('admin.users.store') }}" method="post">

              @csrf
              @include('backend.users._form')

              <div class="d-flex justify-content-between align-items-end">
                <div class="d-flex justify-content-between align-items-end">
                  <button type="submit" class="btn btn-lg btn-outline-primary mr-2">Сохранить</button>
                  <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary">Отменить</a>
                </div>
                <p class="text-muted">
                  <span class="required">*</span>
                  <em>Отмечены обязательные поля</em>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

