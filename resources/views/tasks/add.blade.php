<div class="modal fade bs-add-rule-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form class="task-add-form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <div class="title-icon">
            <span class="fa fa-plus"></span>
            <h4 class="modal-title" id="myModalLabel">Add Task</h4>
          </div>
        </div>
            {{ csrf_field() }}
        <div class="modal-body">
            
          <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align:center">Schedule</label>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="task_name" placeholder="Task Name">
            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
          </div>
          <div class="col-md-12">
            Date and Time
            <div class="control-group">
              <div class="controls">
                <div class="input-prepend input-group">
                  <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                  <input type="text" name="reservation_time" id="reservation-time"  class="form-control" value="11/01/2017 - 11/25/2017" />
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="description" placeholder="Description">
            <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
          </div>

           <div class="form-group">
            <div class="col-md-12 col-sm-9 col-xs-12">
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyhour"/> EveryHour
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyday" checked /> Everyday
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyweek"/> EveryWeek
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everymonth"/> EveryMonth
                </label>
              </div>
              <div class="schedule-repetition">
                <label>
                  <input type="checkbox" name="everyyear"/> EveryYear
                </label>
              </div>
              
            </div>
          </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> From </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="from_regex" placeholder="Regular Expression">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> Recipient </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="recipient_regex" placeholder="Regular Expression">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> Subject </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="subject_regex" placeholder="Regular Expression">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

          <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center"><label> Body </label></div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_equal" placeholder="Equal">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_contains" placeholder="Contains">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_start" placeholder="Start With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_end" placeholder="End With">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="body_regex" placeholder="Regular Expression">
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