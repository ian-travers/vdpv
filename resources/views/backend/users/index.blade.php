@extends('layouts.backend')

@section('content')
  {{-- Modal --}}
  <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
       aria-labelledby="changePasswordModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="changePasswordModalTitle">Смена пароля</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="{{ route('admin.users.change-password') }}" method="post"
              class="bootstrap-modal-form">

          @csrf
          @method('patch')
          <div class="modal-body">
            <input type="hidden" name="userId" id="user-id">
            <p class="text-center">Пользователь</p>
            <p class="display-4 text-center" id="username">NAME</p>

            @include('backend.users._formPassword')
            <div class="d-flex justify-content-between align-items-end border-top pt-3">
              <button type="submit" class="btn btn-lg btn-outline-primary">Сменить пароль</button>
              <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Отменить
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  {{--End Modal--}}

  <div class="card">
    <div class="card-header bg-light">
      <div class="d-flex justify-content-between align-items-start">
        <h3>Управление пользователями</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary">Добавить пользователя</a>
      </div>
    </div>

    @if(count($users))
      @include('backend.users.table')
      <div class="px-3">
        {{ $users->appends(request()->except('page'))->links() }}
      </div>

    @endif
  </div>
@endsection

@section('script')
  <script>
      $('#changePasswordModal').on('show.bs.modal', function (e) {
          let invoker = $(e.relatedTarget);
          let userId = invoker.data('user-id');
          let userName = invoker.data('user-name');

          $('#user-id').val(userId);
          $('#username').text(userName);
      })
  </script>
@endsection


