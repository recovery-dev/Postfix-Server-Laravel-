<div class="modal fade bs-edit-rule-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form class="task-edit-form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <div class="title-icon">
            <span class="fa fa-plus"></span>
            <h4 class="modal-title" id="myModalLabel">Edit Task</h4>
          </div>
        </div>
            {{ csrf_field() }}
        <div class="modal-body">
            
          <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align:center">Schedule</label>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="task_name" id="task_name" placeholder="Task Name">
            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
          </div>
          <div class="col-md-12">
              Date and Time
              <div class="control-group">
                <div class="controls">
                  <div class="input-prepend input-group">
                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                    <input type="text" name="reservation-time" id="reservation-time" class="form-control task-time" value="11/01/2017 - 11/25/2017" />
                  </div>
                </div>
              </div>
          </div>
          <input type="hidden" name="id" id="task-edit-id">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="description" id="description" placeholder="Description">
            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
          </div>

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyhour" id="everyhour"/> EveryHour
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyday" id="everyday" checked /> Everyday
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyweek" id="everyweek"/> EveryWeek
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everymonth" id="everymonth"/> EveryMonth
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyyear" id="everyyear"/> EveryYear
                </label>
              </div>
              
            </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> From </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_equal" id="from_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_contains" id="from_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_start" id="from_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_end" id="from_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_regex" id="from_regex" placeholder="Regular Expression">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> Recipient </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_equal" id="recipient_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_contains" id="recipient_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_start" id="recipient_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_end" id="recipient_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_regex" id="recipient_regex" placeholder="Regular Expression">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> Subject </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_equal" id="subject_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_contains" id="subject_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_start" id="subject_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_end" id="subject_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_regex" id="subject_regex" placeholder="Regular Expression">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> Body </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_equal" id="body_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_contains" id="body_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_start" id="body_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_end" id="body_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_regex" id="body_regex" placeholder="Regular Expression">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>

    </div>
  </div>
</div>