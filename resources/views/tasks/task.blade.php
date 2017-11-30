@extends('layouts.blank')

@section('main_container')

    <div class="right_col" role="main">
      <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Tasks</h3>
        </div>
        @include('tasks/add')
        @include('tasks/edit')
        @include('tasks/delete')
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
                <li><a class="config-add" data-toggle="modal" data-target=".bs-add-rule-modal-lg"><i class="fa fa-plus-circle"></i></a>
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
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>№</th>
                    <th>Task Name</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Settings</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($tasks as $key=>$val)
                  <input type="hidden" id="task_edit_id" value="{!! $val->id !!}">
                    <tr>
                      <td>{{++$key}}</td>
                      <td>{{$val->task_name}}</td>
                      <td>{{$val->status}}</td>
                      <td>{{$val->description}}</td>
                      <td>{{$val->date}}</td>
                      <td>{{$val->time}}</td>
                      
                      <td>
                        
                      <button class="btn btn-primary task-edit" type="button" data-toggle="modal" data-id="{{$val->id}}" data-target=".bs-edit-rule-modal-lg">Edit</button>
                      <button class="btn btn-primary task-del" type="button"  data-toggle="modal" data-target=".bs-delete-rule-modal-sm">Delete</button>
                      {{ Form::open(['url' => ['task/delete', $val->id ], 'method'=>'delete', 'class'=>'delete-form']) }}                        
                        {{ csrf_field() }}
                        <button class="task-delete btn btn-primary" type="submit"></button>
                      {{ Form::close() }}
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
@endsection