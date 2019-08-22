<div id="at-time-report" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Формирование отчета</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3 class="text-center mb-4">Выберите дату-время</h3>

        <form action="{{ route('reports.at-time', ['time']) }}">

          <div class="d-flex justify-content-center align-items-start">
            <div class="form-group">
              <div class="input-group" id="time" data-target-input="nearest">
                <input type="text" id="dtp_time"
                       name="time"
                       class="form-control datetimepicker-input {{ $errors->has('time') ? 'is-invalid' : '' }}"
                       data-target="#time"
                />
                <div class="input-group-append" data-target="#time" data-toggle="datetimepicker">
                  <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
              </div>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-end border-top">
            <button type="submit" class="btn btn-lg btn-outline-primary mt-3">Сформировать отчет</button>
            <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Отмена</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

