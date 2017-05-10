<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 10.05.17
 * Time: 1:00
 */
?>
<div class="modal-header light-blue darken-3 white-text">
    <button type="button" class="close waves-effect waves-light" data-dismiss="modal"
            aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="title">
        <i class="fa fa-pencil"></i>
        @lang('labels.edit')
    </h4>
</div>
{!! Form::model($model, ['ajax', 'route' => array('users.update', $model->id), 'method' => 'PUT', 'postAjax' => 'user-updated']) !!}
<div class="modal-body mb-0">
    <div class="md-form form-sm">
        <i class="fa fa-user prefix"></i>
        {!! Form::text('name', null, array('id' => 'name', 'class' => 'form-control', 'placeholder' => trans('labels.name'))) !!}
    </div>

    <div class="md-form form-sm">
        <i class="fa fa-envelope prefix"></i>
        {!! Form::input('email', 'email', null, array('id' => 'email', 'class' => 'form-control', 'placeholder' => trans('labels.email'))) !!}
    </div>
    <div class="text-center mt-1-half">
        <button class="btn btn-info mb-2">
            @lang('labels.save')
            <i class="fa fa-save ml-1"></i>
        </button>
    </div>
</div>
{!! Form::close() !!}
