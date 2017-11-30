<div class="modal fade bs-create-mailbox-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <div class="title-icon">
          <h4 class="modal-title" id="myModalLabel2">Create Mailbox</h4>
        </div>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
       
        <lable>Please input the name of the mailbox</p>
        <input type="text" class="btn btn-default col-md-12" id="mailbox-name" placeholder="Mailbox">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary create-mailbox" data-dismiss="modal">Create</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>