<div class="modal fade bs-delete-mailbox-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <div class="title-icon">
          <span class="fa fa-warning"></span>
          <h4 class="modal-title" id="myModalLabel2">Delete Mailbox</h4>
        </div>
      </div>
      <div class="modal-body">
        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
       
       <p>Are you sure you want to delete this mailbox? This mailbox will be deleted permanently</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary delete-mailbox" data-dismiss="modal">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>

    </div>
  </div>
</div>