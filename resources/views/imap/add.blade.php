<div class="modal fade bs-add-imap-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="imap-add-form">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
          <div class="title-icon">
            <span class="fa fa-plus"></span>
            <h4 class="modal-title" id="myModalLabel">Add IMAP Account</h4>
          </div>
     
        </div>
        <div class="modal-body">
            {{ csrf_field() }}
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="username" placeholder="User Name">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>
            
            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="password" placeholder="Password">
              <span class="fa fa-lock form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="fqdn" placeholder="FQDN">
              <span class="fa fa-cloud form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="port" placeholder="Port">
              <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="protocol">
                  <option value="default">Choose protocol</option>
                  <option value="SSL">SSL</option>
                  <option value="TLS">TLS</option>
                </select>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
              <input type="text" class="form-control has-feedback-left" name="folder_name" placeholder="Folder Name">
              <span class="fa fa-folder-open form-control-feedback left" aria-hidden="true"></span>
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