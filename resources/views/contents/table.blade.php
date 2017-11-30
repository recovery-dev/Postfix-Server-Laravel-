<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Inbox</h3>
      @include('contents/create')
      @include('contents/delete')
    </div>
    <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>  
    </div>
  </div>
  
  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Settings 1</a>
                </li>
                <li><a href="#">Settings 2</a>
                </li>
              </ul>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
       
           <div class="row">
            <div class="col-sm-3 mail_list_column">
              <div class='move-to-modal'><h3 class='move-to'>Move to...</h3></div>
              <button id="compose" class="btn btn-sm btn-success btn-block" data-toggle="modal" data-target=".bs-create-mailbox-modal-sm">Create Mailbox</button>
              <label for="IMAP folder">Mailbox</label>
              <select id="mailbox" class="form-control" required="">
                <option value="inbox">Inbox</option>
                <option value="archive">Archive</option>
              </select>
              <input type="hidden" name="sequence" id="sequence">
              @foreach($contents as $key=>$val)
              <input type="hidden" id="imap_account_id" value="{!! $val->account_id !!}">
              <a href="javascript:void(0)" class="email-item" data-id="{!! $val->id !!}" data-act_id="{!! $val->account_id!!}" data-seq="{{$val->sequence}}">
                <div class="mail_list">
                  <div class="left">
                    @if ($val->status === 'orange')
                    <i class="fa fa-circle mail_task_status" style="color:orange"></i> <i class="fa fa-edit"></i>
                    @endif
                    @if ($val->status === 'green')
                    <i class="fa fa-circle mail_task_status" style="color:green"></i> <i class="fa fa-edit"></i>
                    @endif
                    @if ($val->status === 'red')
                    <i class="fa fa-circle mail_task_status" style="color:red"></i> <i class="fa fa-edit"></i>
                    @endif
                  </div>
                  <div class="right">
                    <h3>{!! $val->sender !!} <small>{!! $val->receive_time !!}</small></h3>
                    <p>{!! $val->subject !!}</p>
                  </div>
                </div>
              </a>
              @endforeach
            </div>
            <!-- /MAIL LIST -->

            <!-- CONTENT MAIL -->
            <div class="col-sm-9 mail_view">
              <div class="inbox-body">
                <div class="mail_heading row">
                  <div class="col-md-8">
                    <div class="btn-group">
                      <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target=".bs-delete-mailbox-modal-sm"><i class="fa fa-reply"></i> Delete Mailbox</button>
                      <button class="btn btn-sm btn-default mark-as-read" type="button"  data-placement="top" data-toggle="tooltip" data-original-title="Mark as read"><i class="fa fa-eye-slash"></i></button>
                      <button class="btn btn-sm btn-default mark-as-unread" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Mark as unread"><i class="fa fa-envelope-o"></i></button>
                      <button class="btn btn-sm btn-default move-to" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Move to"><i class="fa fa-location-arrow"></i></button>
                      <button class="btn btn-sm btn-default delete-email" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></button>
                    </div>
                  </div>
                  <div class="col-md-4 text-right">
                    <p class="date mail_date"> </p>
                  </div>
                  <div class="col-md-12">
                    <h4 class="mail_subject"></h4>
                  </div>
                </div>
                <div class="sender-info">
                  <div class="row">
                    <div class="col-md-12">
                      <span class="mail_sender"></span> to
                      <strong>me</strong>
                      <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                    </div>
                  </div>
                </div>
                <div class="view-mail">
                  <p class="mail_body">Contents</p>
                </div>
                <div class="attachment">
                  <p>
                    <span><i class="fa fa-paperclip"></i> 3 attachments — </span>
                    <a href="#">Download all attachments</a> |
                    <a href="#">View all images</a>
                  </p>
                  <ul>
                    <li>                                                       
                      <a href="#" class="atch-thumb">
                        <img src="https://colorlib.com/polygon/gentelella/images/inbox.png" alt="img" />
                      </a>

                      <div class="file-name">
                        image-name.jpg
                      </div>
                      <span>12KB</span>


                      <div class="links">
                        <a href="#">View</a> -
                        <a href="#">Download</a>
                      </div>
                    </li>

                    <li>
                      <a href="#" class="atch-thumb">
                        <img src="https://colorlib.com/polygon/gentelella/images/inbox.png" alt="img" />
                      </a>

                      <div class="file-name">
                        img_name.jpg
                      </div>
                      <span>40KB</span>

                      <div class="links">
                        <a href="#">View</a> -
                        <a href="#">Download</a>
                      </div>
                    </li>
                    <li>
                      <a href="#" class="atch-thumb">
                        <img src="https://colorlib.com/polygon/gentelella/images/inbox.png" alt="img" />
                      </a>

                      <div class="file-name">
                        img_name.jpg
                      </div>
                      <span>30KB</span>

                      <div class="links">
                        <a href="#">View</a> -
                        <a href="#">Download</a>
                      </div>
                    </li>

                  </ul>
                </div>
              
              </div>

            </div>
            <!-- /CONTENT MAIL -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
