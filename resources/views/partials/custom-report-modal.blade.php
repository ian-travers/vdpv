<div id="custom-report" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Выбор перода для отчета</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center mb-4">Выберите диапазон</h3>

        <form action="">

          @csrf
          <div class="d-md-inline-flex justify-content-lg-start align-items-start">
            <div class="form-group mr-2">
              <label for="dtp_start" class="text-center d-block">Начало</label>
              <div class="input-group" id="start" data-target-input="nearest">
                <input type="text" id="dtp_start"
                       name="start"
                       class="form-control datetimepicker-input {{ $errors->has('start') ? 'is-invalid' : '' }}"
                       data-target="#start"
                />
                <div class="input-group-append" data-target="#start" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>

            <div class="form-group mr-2">
              <label for="dtp_end" class="text-center d-block">Окончание</label>
              <div class="input-group" id="end" data-target-input="nearest">
                <input type="text" id="dtp_end"
                       name="end"
                       class="form-control datetimepicker-input {{ $errors->has('end') ? 'is-invalid' : '' }}"
                       data-target="#end"
                />
                <div class="input-group-append" data-target="#end" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="d-flex justify-content-between align-items-end p-3 border-top">
        <button type="button" class="btn btn-lg btn-outline-primary mt-3">Сформировать отчет</button>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Отмена</button>
      </div>
    </div>
  </div>
</div>

